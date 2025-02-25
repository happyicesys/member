<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\PlanItemUser;
use App\Models\User;
use Carbon\Carbon;

class PlanService
{
    public function getDefaultPlan()
    {
        return Plan::findOrFail(3);
    }

    /**
     * Synchronize a user's plan items.
     */
    public function syncPlan($userID, $planID)
    {
        $plan = Plan::findOrFail($planID);
        $user = User::findOrFail($userID);

        // Fetch the existing active PlanItemUser for the user and plan item
        $isExisting = PlanItemUser::where('user_id', $userID)
            ->where('plan_id', $planID)
            ->where('is_active', true)
            ->latest()
            ->first();

        // Determine the start date (latest of user or plan item creation)
        $startDate = max(Carbon::parse($user->created_at), Carbon::parse($plan->created_at));

        if ($isExisting) {
            // If the current plan item has expired
            if ($isExisting->datetime_to < Carbon::today()) {
                $isExisting->update(['is_active' => false]);
            }
        } else {
            // Create a new PlanItemUser entry for a new item
            $this->createNewPlanItemUser($userID, $planID, $startDate);
        }
    }

    /**
     * Create a new PlanItemUser entry.
     */
    public function createNewPlanItemUser($userID, $planID, $startDate)
    {
        $datetimeTo = $this->calculateEndDate($startDate, $planID);

        PlanItemUser::create([
            'datetime_from' => $startDate,
            'datetime_to' => $datetimeTo,
            'is_active' => true,
            'plan_id' => $planID,
            'used_count' => 0, // Initialize usage
            'user_id' => $userID,
        ]);
    }

    /**
     * Calculate the next cycle end date based on the frequency of the plan item.
     */
    private function calculateEndDate($startDate, $planID)
    {
        $plan = Plan::findOrFail($planID);

        $planItem = PlanItem::where('plan_id', $planID)->where('is_base', true)->first();

        switch ($planItem->frequency) {
            case 'daily':
                return Carbon::parse($startDate)->addDays($planItem->cycle);
            case 'weekly':
                return Carbon::parse($startDate)->addWeeks($planItem->cycle);
            case 'monthly':
                return Carbon::parse($startDate)->addMonths($planItem->cycle);
            case 'annually':
                return Carbon::parse($startDate)->addYears($planItem->cycle);
            default:
                return Carbon::parse($startDate)->addMonths($planItem->cycle);
        }
    }

    /**
     * Sync all plan items for a user.
     */
    public function syncUserPlan($user)
    {
        $planItemUser = $user->planItemUser;

        if (!$planItemUser or !$planItemUser->plan) {
            $this->syncPlan($user->id, $this->getDefaultPlan()->id);
            return;
        }

        $this->syncPlan($user->id, $planItemUser->plan_id);
    }
}
