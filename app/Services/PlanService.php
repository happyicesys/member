<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class PlanService
{
    public function setDefaultPlan($user)
    {
        $plan = Plan::where('level', 2)->first();
        $user->update(['plan_id' => $plan->id]);
    }
}
