<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Services\IsmsService;
use App\Services\OneWaySmsService;

class OTPService
{
    // The length of OTP (e.g., 5-digit OTP)
    const OTP_LENGTH = 5;

    // OTP expiry time in seconds (e.g., 5 minutes)
    const OTP_EXPIRY = 300;

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
        // Store OTP in cache for 5 minutes
        Cache::put($key, $otp, self::OTP_EXPIRY);  // OTP expires after 300 seconds (5 minutes)
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
        // Send the OTP via the selected SMS service
        $message = "Your DCVend OTP is: $otp";  // Customize the message as needed
        $this->smsService->sendSms([$phoneNumber], $message);  // Send OTP to user's phone number
    }

    /**
     * Verify the OTP entered by the user.
     * Checks the OTP stored in the cache and matches it with the user input.
     *
     * @param string $key
     * @param string $otp
     * @return bool
     */
    public function verifyOtp(string $key, string $otp): bool
    {
        // Retrieve the stored OTP from cache
        $storedOtp = Cache::get($key);

        // If OTP exists in the cache and matches the user's input
        if ($storedOtp && $storedOtp === $otp) {
            // OTP is valid, clear it from the cache
            Cache::forget($key);  // Optional: clear OTP after successful verification
            return true;
        }

        return false;  // OTP is invalid or expired
    }
}
