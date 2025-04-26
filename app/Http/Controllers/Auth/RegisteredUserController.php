<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\CountryResource;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\OTPService;
use App\Services\IsmsService;
use App\Services\OneWaySmsService;
use App\Services\PlanService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
// use Stevebauman\Location\Facades\Location;

class RegisteredUserController extends Controller
{
    protected $otpService;
    protected $planService;
    protected $userService;

    public function __construct()
    {
        // Dynamically select the SMS service based on the environment variable
        $smsService = $this->getSmsService();
        $this->otpService = new OTPService($smsService);
        $this->planService = new PlanService();
        $this->userService = new UserService();
    }

    /**
     * Dynamically select the SMS service based on the .env configuration
     */
    private function getSmsService()
    {
        $smsService = config('sms.sms_service');  // Read from .env

        switch ($smsService) {
            case 'oneway':
                return new OneWaySmsService();
            case 'isms':
            default:
                return new IsmsService();
        }
    }

    /**
     * Display the registration view.
     */
    public function create($refID = null): Response
    {
        return Inertia::render('Auth/Register', [
            'countryOptions' => CountryResource::collection(
                Country::query()
                ->where('is_active', true)
                ->orderByRaw('ISNULL(sequence), sequence ASC')
                ->orderBy('phone_code')
                ->get()
            ),
            'refID' => $refID,
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $this->validateResetRequest($request);

        // Verify OTP
        $this->validateOtp($request);

        // Find user by phone country ID and phone number
        $user = User::where('phone_country_id', $request->country_id)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$user) {
            return back()->withErrors(['phone_number' => 'Phone number not registered.']);
        }

        // Reset the password
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => \Illuminate\Support\Str::random(60),
        ])->save();

        // Fire password reset event
        event(new PasswordReset($user));

        return redirect()->route('login');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validateRequest($request);

        // Verify OTP
        $this->validateOtp($request);

        // Create the user
        $user = User::create([
            'dob' => $request->dob,
            'name' => $request->name,
            'email' => $request->email,
            'is_details_filled' => true,
            'is_phone_number_validated' => true,
            'password' => Hash::make($request->password),
            'phone_country_id' => $request->country_id,
            'phone_number' => $request->phone_number,
            'phone_number_verified_at' => Carbon::now(),
        ]);

        $this->userService->createReferral($user);

        if($request->ref_id) {
            $this->userService->assignReferral($user, $request->ref_id);
        }

        // Sync user plan
        $this->planService->syncUserPlan($user);

        $this->userService->validateIsActiveCountry($request->country_id);


        // Fire the Registered event and log the user in
        event(new Registered($user));
        Auth::login($user);

        $user->update([
            'login_count' => $user->login_count + 1
        ]);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Verify the user's phone number by sending an OTP.
     */
    public function verifyPhoneNumber(Request $request)
    {
        $this->validateRequest($request);

        $ipKey = 'otp_ip_' . $request->ip();
        $phoneKey = 'otp_request_' . $request->full_phone_number;

        // Apply throttling
        $this->otpService->throttleOtpRequests($ipKey, true);
        $this->otpService->throttleOtpRequests($phoneKey);

        // Generate and send OTP
        $this->sendOTP($request);

        return redirect()->back();
    }


    /**
     * Generate, store, and send OTP to the user.
     */
    private function sendOTP(Request $request)
    {
        $otp = $this->otpService->generateOtp();
        $this->otpService->storeOtp($request->full_phone_number, $otp);
        $this->otpService->sendOtp($request->full_phone_number, $otp);
    }

    /**
     * Validate the OTP provided by the user during registration.
     */
    private function validateOtp(Request $request)
    {
        $request->merge([
            'otp' => implode('', $request->otpParts),
        ]);

        $request->validate([
            'otp' => 'required|digits:5',
        ]);

        $otpValid = $this->otpService->verifyOtp($request->full_phone_number, $request->otp);

        if (!$otpValid) {
            throw ValidationException::withMessages([
                'otp' => 'Invalid OTP.',
            ]);
        }
    }

    /**
     * Validate registration request.
     */
    private function validateRequest(Request $request)
    {
        // validate request ip is from Singapore
        // $ip = $request->ip();
        // $location = Location::get($ip);
        // if ($location && ($location->countryCode !== 'SG' || $location->countryCode !== 'MY')) {
        //     return;
        // }

        $country = Country::find($request->country_id);

        if (!$country) {
            throw ValidationException::withMessages([
                'country_id' => 'Invalid country selected.',
            ]);
        }

        $request->merge([
            'full_phone_number' => $country->phone_code . $request->phone_number,
        ]);

        $request->validate([
            'country_id' => 'required|integer|exists:countries,id',
            'dob' => 'date|before:-10 years',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'name' => 'required|string|max:255',
            'password' => 'required|digits:6',
            // 'passwordParts.*' => 'required|digits:1',
            'phone_number' => 'required|string|phone:' . $country->abbreviation,
            'recaptcha_token' => 'required|recaptchav3:register,0.7'
        ]);

        // Validate phone number
        $replicatedNumber = User::where('phone_country_id', $request->country_id)
            ->where('phone_number', $request->phone_number)
            ->first();
        if($replicatedNumber) {
            throw ValidationException::withMessages([
                'phone_number' => 'Phone number already exists.',
            ]);
        }
    }

    private function validateResetRequest(Request $request)
    {
        $country = Country::find($request->country_id);

        if (!$country) {
            throw ValidationException::withMessages([
                'country_id' => 'Invalid country selected.',
            ]);
        }

        $request->merge([
            'full_phone_number' => $country->phone_code . $request->phone_number,
        ]);

        $request->validate([
            'country_id' => 'required|integer|exists:countries,id',
            'password' => 'required|digits:6',
            'phone_number' => 'required|string|phone:' . $country->abbreviation,
        ]);

        // Validate phone number
        $existedNumber = User::where('phone_country_id', $request->country_id)
        ->where('phone_number', $request->phone_number)
        ->first();

        if(!$existedNumber) {
            throw ValidationException::withMessages([
                'phone_number' => 'Phone number havent registered yet.',
            ]);
        }
    }
}
