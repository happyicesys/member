<?php

namespace App\Services;

use App\Models\Country;
use Carbon\Carbon;

class UserService
{
    public function assignReferral($user, $refID)
    {
        $user->ref_id = $refID;
        $user->save();
    }

    public function validateIsActiveCountry($countryID)
    {
        $country = Country::find($countryID);

        if(!$country) {
            return false;
        }

        if(!$country->is_active) {
            $country->is_active = true;
            $country->save();

            // trigger SysApiService to update vends by mqtt
        }
    }
}