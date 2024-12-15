<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Singapore', 'abbreviation' => 'SG', 'currency_name' => 'SGD', 'currency_exponent' => 2, 'currency_symbol' => 'S$', 'phone_code' => '+65', 'timezone' => 'Asia/Singapore', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => true, 'sequence' => 1],
            ['name' => 'China', 'abbreviation' => 'CN', 'currency_name' => 'CNY', 'currency_exponent' => 2, 'currency_symbol' => '¥', 'phone_code' => '+86', 'timezone' => 'Asia/Shanghai', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 5],
            ['name' => 'India', 'abbreviation' => 'IN', 'currency_name' => 'INR', 'currency_exponent' => 2, 'currency_symbol' => '₹', 'phone_code' => '+91', 'timezone' => 'Asia/Kolkata', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 4],
            ['name' => 'Indonesia', 'abbreviation' => 'ID', 'currency_name' => 'IDR', 'currency_exponent' => 2, 'currency_symbol' => 'Rp', 'phone_code' => '+62', 'timezone' => 'Asia/Jakarta', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 2],
            ['name' => 'Japan', 'abbreviation' => 'JP', 'currency_name' => 'JPY', 'currency_exponent' => 0, 'currency_symbol' => '¥', 'phone_code' => '+81', 'timezone' => 'Asia/Tokyo', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 7],
            ['name' => 'Malaysia', 'abbreviation' => 'MY', 'currency_name' => 'MYR', 'currency_exponent' => 2, 'currency_symbol' => 'RM', 'phone_code' => '+60', 'timezone' => 'Asia/Kuala_Lumpur', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 3],
            ['name' => 'Philippines', 'abbreviation' => 'PH', 'currency_name' => 'PHP', 'currency_exponent' => 2, 'currency_symbol' => '₱', 'phone_code' => '+63', 'timezone' => 'Asia/Manila', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 6],
            ['name' => 'South Korea', 'abbreviation' => 'KR', 'currency_name' => 'KRW', 'currency_exponent' => 0, 'currency_symbol' => '₩', 'phone_code' => '+82', 'timezone' => 'Asia/Seoul', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 8],
            ['name' => 'United Kingdom', 'abbreviation' => 'GB', 'currency_name' => 'GBP', 'currency_exponent' => 2, 'currency_symbol' => '£', 'phone_code' => '+44', 'timezone' => 'Europe/London', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 10],
            ['name' => 'United States', 'abbreviation' => 'US', 'currency_name' => 'USD', 'currency_exponent' => 2, 'currency_symbol' => '$', 'phone_code' => '+1', 'timezone' => 'America/New_York', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 11],
            ['name' => 'Australia', 'abbreviation' => 'AU', 'currency_name' => 'AUD', 'currency_exponent' => 2, 'currency_symbol' => '$', 'phone_code' => '+61', 'timezone' => 'Australia/Sydney', 'is_currency_exponent_hidden' => false, 'is_active' => true, 'is_default' => false, 'sequence' => 9],
        ];


        // Sort the countries alphabetically by their name
        usort($countries, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        // Insert the residents into the database
        DB::table('countries')->insert($countries);
    }
}
