<?php

namespace App\Services;
use App\Models\Setting;
use Carbon\Carbon;

class SettingService
{
    public function updateTotalDiscountAmount($amount)
    {
        $setting = Setting::first();
        if ($setting) {
            $setting->update([
                'total_discount_amount' => $setting->total_discount_amount + $amount,
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}