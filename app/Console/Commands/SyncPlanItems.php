<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Plan;
use App\Services\PlanService;
use App\Models\User;
use Carbon\Carbon;

class SyncPlanItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync plan items for users whose plans are expiring and process scheduled downgrades';

    /**
     * Execute the console command.
     */
    public function handle(PlanService $planService)
    {
        $freePlanId = app(PlanService::class)->getDefaultFreePlan()->id;
        $now = Carbon::now();
        $gracePeriodEnd = $now->subDays(Plan::GRACE_PERIOD_DAYS);

        // **1️⃣ Process Users with Soon-to-Expire Plans (Respecting Grace Period)**
        $users = User::whereHas('planItemUser', function ($query) use ($freePlanId, $now) {
            $query->where('plan_id', '!=', $freePlanId) // Exclude free plan
                  ->whereNotNull('datetime_to') // Ensure expiration date exists
                  ->where('datetime_to', '<', $now->addDays(Plan::GRACE_PERIOD_DAYS)); // Only process within grace period
        })->get();

        foreach ($users as $user) {
            $planService->syncUserPlan($user);
        }

        // **2️⃣ Process Scheduled Downgrades (After Grace Period)**
        $usersWithScheduledDowngrades = User::whereHas('planItemUser', function ($query) use ($gracePeriodEnd) {
            $query->whereNotNull('scheduled_downgrade_plan_id')
                  ->whereNotNull('datetime_to') // Ensure expiration date exists
                  ->where('datetime_to', '<', $gracePeriodEnd); // Only process AFTER grace period ends
        })->get();

        foreach ($usersWithScheduledDowngrades as $user) {
            $currentPlanItemUser = $user->planItemUser;
            if ($currentPlanItemUser) {
                $planService->syncPlan($user->id, $currentPlanItemUser->scheduled_downgrade_plan_id);
                $downgradePlan = Plan::findOrFail($currentPlanItemUser->scheduled_downgrade_plan_id);

                $downgradeSubscriptionName = strtolower(preg_replace('/\s+/', '_', trim($downgradePlan->name)));
                $currentSubscription = $user->subscription(strtolower(preg_replace('/\s+/', '_', trim($currentPlanItemUser->plan->name))));

                $currentSubscription->update([
                    'type' => $downgradeSubscriptionName
                ]);
                $currentPlanItemUser->update(['scheduled_downgrade_plan_id' => null]); // Clear downgrade after applying
            }
        }

        $this->info('Plan items and scheduled downgrades synced successfully.');
    }

}


