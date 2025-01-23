<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\CountryResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Country;
use App\Models\User;
use App\Services\OTPService;
use App\Services\IsmsService;
use App\Services\OneWaySmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    protected $otpService;

    public function __construct()
    {
        // Dynamically select the SMS service based on the environment variable
        $smsService = $this->getSmsService();
        $this->otpService = new OTPService($smsService);
    }
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'countryOptions' => CountryResource::collection(
                Country::orderByRaw('ISNULL(sequence), sequence ASC')
                ->orderBy('phone_code')
                ->get()
            ),
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function forgot()
    {
        return Inertia::render('Auth/Forgot', [
            'countryOptions' => CountryResource::collection(
                Country::orderByRaw('ISNULL(sequence), sequence ASC')
                ->orderBy('phone_code')
                ->get()
            ),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updateForgot(Request $request): RedirectResponse
    {
        $this->validatePhoneNumber($request);

        // Verify OTP
        $this->validateOtp($request);

        $request->validate([
            'otpParts.*' => 'required|digits:1',
        ]);

        $request->merge([
            'otp' => implode('', $request->otpParts),
        ]);

        $user = User::where('phone_number', $request->phone_number)->where('phone_country_id', $request->country_id)->first();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function verifyForgot(Request $request): RedirectResponse
    {
        $this->validatePhoneNumber($request);

        // Send OTP
        $this->sendOTP($request);

        return redirect()->back();
    }

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
     * Generate, store, and send OTP to the user.
     */
    private function sendOTP(Request $request)
    {
        $otp = $this->otpService->generateOtp();
        $this->otpService->storeOtp($request->full_phone_number, $otp);
        $this->otpService->sendOtp($request->full_phone_number, $otp);
    }

    private function validateOtp(Request $request)
    {
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

    private function validatePhoneNumber(Request $request)
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
            'phone_number' => 'required|string|phone:' . $country->abbreviation,
        ]);

        $user = User::where('phone_number', $request->phone_number)
                ->where('phone_country_id', $request->country_id)
                ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone_number' => 'Phone number not found.',
            ]);
        }
    }
}
