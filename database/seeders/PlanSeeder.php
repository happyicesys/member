<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Basic Member
        Plan::create([
            'name' => 'Basic Member',
            'level' => 1,
            'price' => 0, // Free
            'desc' => 'Enjoy 5% discount for every purchase.',
            'is_active' => true,
            'base_discount_percent' => 5,
            'is_stackable' => false,
            'is_monthly_discount_voucher' => false,
            'monthly_discount_voucher_count' => 0,
            'monthly_discount_voucher_percent' => 0,
            'is_monthly_free_item' => false,
            'monthly_free_item_count' => 0,
            'monthly_free_item_label' => null,
            'monthly_free_item_ref_id' => null,
        ]);

        // VIP Member
        Plan::create([
            'name' => 'VIP Member',
            'level' => 2,
            'price' => 3, // $3.00 per month
            'desc' => '25% discount every purchase. Monthly: Free x2 vouchers for 40% discount. Monthly: Free 1x Cornetto voucher (worth $3.00).',
            'is_active' => true,
            'base_discount_percent' => 25,
            'is_stackable' => false,
            'is_monthly_discount_voucher' => true,
            'monthly_discount_voucher_count' => 2,
            'monthly_discount_voucher_percent' => 40,
            'is_monthly_free_item' => true,
            'monthly_free_item_count' => 1,
            'monthly_free_item_label' => 'Monthly: Free 1x Cornetto voucher (worth $3.00)',
            'monthly_free_item_ref_id' => 'classic_cornetto',
        ]);

        // Super VIP Member
        Plan::create([
            'name' => 'Super VIP Member',
            'level' => 3,
            'price' => 4.7, // $4.70 per month
            'desc' => '25% discount every purchase. Monthly: Free x10 vouchers for 40% discount. Monthly: Free 1x Magnum voucher (worth $4.70).',
            'is_active' => true,
            'base_discount_percent' => 25,
            'is_stackable' => false,
            'is_monthly_discount_voucher' => true,
            'monthly_discount_voucher_count' => 10,
            'monthly_discount_voucher_percent' => 40,
            'is_monthly_free_item' => true,
            'monthly_free_item_count' => 1,
            'monthly_free_item_label' => 'Monthly: Free 1x Magnum voucher (worth $4.70)',
            'monthly_free_item_ref_id' => 'magnum_series',
        ]);
    }
}
