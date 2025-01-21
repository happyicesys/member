<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\PlanItemUser;
use App\Models\User;
use Carbon\Carbon;

class PlanService
{
    /**
     * Set the default plan for a user.
     */
    public function setDefaultPlan($user)
    {
        $plan = Plan::where('level', 2)->first();
        $user->update(['plan_id' => $plan->id]);
    }

    /**
     * Synchronize a user's plan items.
     */
    public function syncPlanItems($userID, $planItemID)
    {
        $planItem = PlanItem::findOrFail($planItemID);
        $user = User::findOrFail($userID);

        // Fetch the existing active PlanItemUser for the user and plan item
        $isExisting = PlanItemUser::where('user_id', $userID)
            ->where('plan_item_id', $planItemID)
            ->where('is_active', true)
            ->latest()
            ->first();

        // Determine the start date (latest of user or plan item creation)
        $startDate = max(Carbon::parse($user->created_at), Carbon::parse($planItem->created_at));

        if ($isExisting) {
            // If the current plan item has expired
            if ($isExisting->datetime_to < Carbon::today()) {
                if ($isExisting->cycle_count < $planItem->cycle) {
                    // Add a new cycle if under the maximum limit
                    $this->addNewCycle($isExisting, $planItem);
                } else {
                    // Otherwise, deactivate the item
                    $isExisting->update(['is_active' => false]);
                }
            }
        } else {
            // Create a new PlanItemUser entry for a new item
            $this->createNewPlanItemUser($userID, $planItem, $startDate);
        }
    }

    /**
     * Add a new cycle to an existing PlanItemUser.
     */
    private function addNewCycle($existing, $planItem)
    {
        $datetimeTo = $this->calculateNextCycle($planItem);

        $existing->update([
            'datetime_from' => Carbon::today(),
            'datetime_to' => $datetimeTo,
            'cycle_count' => $existing->cycle_count + 1,
            'is_active' => true,
            'used_count' => 0, // Reset used_count for the new cycle
        ]);
    }

    /**
     * Create a new PlanItemUser entry.
     */
    private function createNewPlanItemUser($userID, $planItem, $startDate)
    {
        $datetimeTo = $this->calculateNextCycle($planItem);

        PlanItemUser::create([
            'cycle_count' => 1, // First cycle
            'datetime_from' => $startDate,
            'datetime_to' => $datetimeTo,
            'is_active' => true,
            'plan_item_id' => $planItem->id,
            'used_count' => 0, // Initialize usage
            'user_id' => $userID,
        ]);
    }

    /**
     * Calculate the next cycle end date based on the frequency of the plan item.
     */
    private function calculateNextCycle($planItem)
    {
        switch ($planItem->frequency) {
            case 'daily':
                return Carbon::today()->addDays(1);
            case 'weekly':
                return Carbon::today()->addWeeks(1);
            case 'monthly':
                return Carbon::today()->addMonths(1);
            case 'annually':
                return Carbon::today()->addYears(1);
            default:
                return Carbon::today()->addMonths(1);
        }
    }

    /**
     * Sync all plan items for a user.
     */
    public function syncUserPlan($user)
    {
        $plan = $user->plan;

        if (!$plan) {
            return;
        }

        // Get all non-base plan items
        $planItems = $plan->planItems;

        foreach ($planItems as $planItem) {
            $this->syncPlanItems($user->id, $planItem->id);
        }
    }
}
