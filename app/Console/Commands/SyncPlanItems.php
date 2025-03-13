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
                ->where('is_active', true) // Only active plans
                ->whereNotNull('datetime_to') // Ensure expiration date exists
                ->where('datetime_to', '<', $now->addDays(Plan::GRACE_PERIOD_DAYS)); // Only process within grace period
        })->get();

        foreach ($users as $user) {
            $planService->syncUserPlan($user);
        }

    }

}


