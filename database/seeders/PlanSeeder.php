<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\User;
use DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Plan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // Free Member
        $freePlan = Plan::create([
            'name' => 'Free Member',
            'level' => 1,
            'price' => 0, // Free
            'desc' => '1 time: 30% discount on all products',
            'is_active' => true,
            'is_available' => false,
            'is_stackable' => false,
        ]);

        PlanItem::create([
            'plan_id' => $freePlan->id,
            'name' => '1 time: 30% discount on all products',
            'cycle' => 1,
            'frequency' => 'monthly',
            'is_base' => true,
            'max_count' => 1,
            'promo_type' => 'percent',
            'promo_value' => 30,
        ]);


        // Gold Member
        $goldPlan = Plan::create([
            'name' => 'Gold Member',
            'level' => 2,
            'price' => 3, // $3.00 per month
            'desc' => '4 times: 30% discount on all products',
            'is_active' => false,
            'is_available' => false,
            'is_stackable' => false,
        ]);

        PlanItem::create([
            'plan_id' => $goldPlan->id,
            'name' => '4 times: 30% discount on all products',
            'cycle' => 2,
            'frequency' => 'monthly',
            'is_base' => false,
            'max_count' => 4,
            'promo_type' => 'percent',
            'promo_value' => 30,
        ]);

        // Gold Member Unlimited
        $goldPlanUnlimited = Plan::create([
            'name' => 'Gold Member',
            'level' => 2,
            'price' => 0, // $3.00 per month
            'desc' => 'Unlimited: 30% discount on all products',
            'is_active' => true,
            'is_available' => true,
            'is_stackable' => false,
        ]);

        PlanItem::create([
            'plan_id' => $goldPlanUnlimited->id,
            'name' => 'Unlimited: 30% discount on all products',
            'cycle' => 2,
            'frequency' => 'monthly',
            'is_base' => true,
            'max_count' => 99,
            'promo_type' => 'percent',
            'promo_value' => 30,
        ]);

        // Platinum Member
        Plan::create([
            'name' => 'Platinum Member',
            'level' => 3,
            'price' => 4.80,
            'desc' => 'Unlimited: 30% discount on all products
            FREE: 1x Magnum ice cream (worth: S$4.70)
            Unlimited: Daily Deals, daily basis
            Unlimited: 8% cashback on orders via Grab
            Unlimited: 8% discount from affiliated vending machines',
            'is_active' => true,
            'is_available' => false,
            'is_stackable' => false,
        ]);

        $users = User::all();

        foreach ($users as $user) {
            $user->update(['plan_id' => $goldPlan->id]);
        }
    }
}
