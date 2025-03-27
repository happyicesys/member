<?php

namespace Database\Seeders;

use App\Models\PlanItemUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetInitPlanRequiredEmailRetention extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planItemUsers = PlanItemUser::where('plan_id', 3)->get();

        foreach ($planItemUsers as $planItemUser) {
            $planItemUser->is_required_email_retention = true;
            $planItemUser->save();
        }
    }
}
