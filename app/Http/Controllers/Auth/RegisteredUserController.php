<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\CountryResource;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\OTPService;
use App\Services\IsmsService;
use App\Services\OneWaySmsService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    protected $otpService;
    protected $userService;

    public function __construct()
    {
        // Dynamically select the SMS service based on the environment variable
        $smsService = $this->getSmsService();
        $this->otpService = new OTPService($smsService);
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
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'countryOptions' => CountryResource::collection(
                Country::orderByRaw('ISNULL(sequence), sequence ASC')
                ->orderBy('phone_code')
                ->get()
            ),
        ]);
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
            'is_phone_number_velidated' => true,
            'password' => Hash::make($request->password),
            'phone_country_id' => $request->country_id,
            'phone_number' => $request->phone_number,
            'phone_number_verified_at' => Carbon::now(),
            'plan_id' => 3,
        ]);

        $this->userService->validateIsActiveCountry($request->country_id);

        // Fire the Registered event and log the user in
        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Verify the user's phone number by sending an OTP.
     */
    public function verifyPhoneNumber(Request $request)
    {
        $this->validateRequest($request);

        // Send OTP
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
            'dob' => 'required|date|before:-10 years',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'name' => 'required|string|max:255',
            'password' => 'required|digits:6',
            // 'passwordParts.*' => 'required|digits:1',
            'phone_number' => 'required|string|phone:' . $country->abbreviation,
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
}
