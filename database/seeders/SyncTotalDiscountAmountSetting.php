<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\VendTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SyncTotalDiscountAmountSetting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::first();
        $totalDiscountAmount = VendTransaction::query()->sum('discount_amount');
        $setting->update([
            'total_discount_amount' => $totalDiscountAmount
        ]);
    }
}
