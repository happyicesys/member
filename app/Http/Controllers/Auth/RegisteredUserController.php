<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\CountryResource;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\OTPService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'countryOptions' => CountryResource::collection(
                Country::orderBy('sequence')->get()
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

        $request->validate([
            'otp' => 'required|digits:5',
        ]);

        $otp = $this->otpService->verifyOtp($request->full_phone_number, $request->otp);

        if (!$otp) {
            throw ValidationException::withMessages([
                'otp' => 'Invalid OTP.',
            ]);
        }

        $request->merge([
            'password' => implode('', $request->passwordParts),
        ]);

        $user = User::create([
            'dob' => $request->dob,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_country_id' => $request->country_id,
            'phone_number' => $request->phone_number,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function verifyPhoneNumber(Request $request)
    {
        $this->validateRequest($request);

        $this->sendOTP($request);

        return redirect()->back();
    }

    private function sendOTP(Request $request)
    {
        $otp = $this->otpService->generateOtp();
        $this->otpService->storeOtp($request->full_phone_number, $otp);
        $this->otpService->sendOtp($request->full_phone_number, $otp);
    }

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
            'passwordParts.*' => 'required|digits:1',
            'phone_number' => 'required|string|phone:' . $country->abbreviation,
        ]);
    }

}
