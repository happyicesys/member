<?php

namespace Database\Seeders;

use App\Models\PlanItemUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanItemUserPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planItemUsers = PlanItemUser::all();

        if($planItemUsers) {
            foreach($planItemUsers as $planItemUser) {
                $planItemUser->plan_id = 3;
                $planItemUser->save();
            }
        }
    }
}
