<?php

namespace App\Services;

use App\Models\Country;
use App\Models\User;
use App\Services\SysApiService;

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
        $user->ref_id = $refID;
        $user->save();
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
