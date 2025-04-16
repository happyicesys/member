<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Referral;
use App\Models\User;
use App\Services\SysApiService;
use Illuminate\Support\Str;

class UserService
{
    /**
     * The SysApiService instance for interacting with the external system.
     */
    protected $sysApiService;

    /**
     * Create a new UserService instance.
     */
    public function __construct()
    {
        $this->sysApiService = new SysApiService();
    }

    /**
     * Assign a referral ID to a user.
     *
     * @param User $user
     * @param string $refID
     * @return void
     */
    public function assignReferral(User $user, string $refID): void
    {
        if($referral = Referral::where('code', $refID)->first()) {
            $user->referral()->update([
                'referral_user_id' => $referral->user_id,
            ]);
        }

        $user->ref_id = $refID;
        $user->save();
    }

    public function createReferral(User $user): void
    {
        $referral = new Referral();
        $referral->user_id = $user->id;
        $referral->code = $this->generateReferralCode();
        $referral->save();
    }

    public function generateReferralCode(): string
    {
        // Generate a unique referral code
        $referralCode = strtoupper(Str::random(6));

        // Ensure the referral code is unique
        while (Referral::where('code', $referralCode)->exists()) {
            $referralCode = strtoupper(Str::random(6));
        }

        return $referralCode;
    }

    /**
     * Validate whether the given country is active.
     * If the country is not active, activate it and update vends via the SysApiService.
     *
     * @param int $countryID
     * @return bool
     */
    public function validateIsActiveCountry(int $countryID): bool
    {
        $country = Country::find($countryID);

        if (!$country) {
            return false; // Country not found
        }

        if (!$country->is_active) {
            $country->is_active = true;
            $country->save();

            // Trigger SysApiService to update vend countries
            $response = $this->sysApiService->updateVendCountries();

            if (!$response) {
                // Handle failure to update vend countries
                return false;
            }
        }

        return true;
    }
}
