<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class OTPService
{
    // The length of OTP (e.g., 5-digit OTP)
    const OTP_LENGTH = 5;

    // OTP expiry time in seconds (e.g., 5 minutes)
    const OTP_EXPIRY = 300;

    // Throttle duration for OTP requests in seconds (e.g., 1 minute)
    const THROTTLE_DURATION = 60;

    protected $smsService;

    // Inject either IsmsService or OneWaySmsService into the OTPService
    public function __construct($smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Generate a random OTP (5 digits).
     *
     * @return string
     */
    public function generateOtp(): string
    {
        return random_int(10000, 99999);  // Generate a 5-digit OTP
    }

    /**
     * Store the OTP in cache for a given key (phone number or user identifier).
     *
     * @param string $key
     * @param string $otp
     * @return void
     */
    public function storeOtp(string $key, string $otp): void
    {
        // Store OTP in cache
        Cache::put($key, $otp, self::OTP_EXPIRY);
    }

    /**
     * Send OTP to the user via the selected SMS service.
     *
     * @param string $phoneNumber
     * @param string $otp
     * @return void
     */
    public function sendOtp(string $phoneNumber, string $otp): void
    {
        \Log::info("Sending OTP $otp to $phoneNumber");
        $message ="DCVend: Your OTP is $otp.
        New member will enjoy 2 months Gold member benefits. Buy 1 piece also get 30% discount";
        $this->smsService->sendSms([$phoneNumber], $message);
    }

    /**
     * Verify the OTP entered by the user.
     *
     * @param string $key
     * @param string $otp
     * @return bool
     */
    public function verifyOtp(string $key, string $otp): bool
    {
        $storedOtp = Cache::get($key);

        if ($storedOtp && $storedOtp === $otp) {
            Cache::forget($key); // Clear OTP after successful verification
            return true;
        }

        return false; // OTP is invalid or expired
    }

    /**
     * Throttle OTP requests to prevent abuse.
     *
     * @param string $key
     * @throws \Illuminate\Validation\ValidationException
     */
    public function throttleOtpRequests(string $key): void
    {
        if (Cache::has($key)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'otp' => 'Please wait before requesting another OTP.',
            ]);
        }

        // Lock the key for the throttle duration
        Cache::put($key, true, self::THROTTLE_DURATION);
    }
}
