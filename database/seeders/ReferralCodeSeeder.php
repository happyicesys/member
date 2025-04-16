<?php

namespace Database\Seeders;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReferralCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('referral')->get();

        foreach ($users as $user) {
            // Check if the user already has a referral code
            if ($user->referral) {
                continue;
            }

            // Generate a unique referral code
            $referralCode = strtoupper(Str::random(6));

            // Ensure the referral code is unique
            while (Referral::where('code', $referralCode)->exists()) {
                $referralCode = strtoupper(Str::random(6));
            }

            // Update the user's referral_code field
            $user->referral()->create(['code' => $referralCode]);
        }
    }
}
