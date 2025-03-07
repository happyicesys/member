<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\PlanItemUser;
use App\Models\User;
use App\Services\PaymentService;
use App\Traits\HasEnvironment;
use Carbon\Carbon;

class PlanService
{
    use HasEnvironment;

    protected $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    public function getDefaultFreePlan()
    {
        return Plan::findOrFail(1);
    }


    public function getDefaultPromoPlan()
    {
        return Plan::findOrFail(3);
    }

    public function getExternalPriceID($plan)
    {
        if($this->isProduction()) {
            return $plan->external_ref_id;
        }else {
            return $plan->external_ref_test_id;
        }
    }

    public function syncPlan($userID, $planID)
    {
        \Log::info("Syncing plan for user ID: {$userID}, plan ID: {$planID}");

        $plan = Plan::findOrFail($planID);
        $user = User::findOrFail($userID);

        $currentPlanItemUser = PlanItemUser::where('user_id', $userID)
            ->where('is_active', true)
            ->latest()
            ->first();

        $renewFrequency = $plan->renew_frequency ?? 'monthly'; // Default to monthly
        $datetimeFrom = Carbon::now();
        $datetimeTo = $this->calculateEndDate($datetimeFrom, $planID);

        // **1️⃣ Handle Upgrades (Immediate Effect)**
        if (!$currentPlanItemUser || $plan->level > $currentPlanItemUser->plan->level || (!$currentPlanItemUser->plan->is_required_payment && $plan->is_required_payment)) {
            \Log::info("Upgrading plan immediately for user ID: {$userID}");

            if ($currentPlanItemUser) {
                $currentPlanItemUser->update([
                    'datetime_to' => Carbon::now(),
                    'is_active' => false,
                ]);
            }

            // Assign new plan immediately
            $this->createNewPlanItemUser($userID, $planID, $datetimeFrom, $datetimeTo);

            // Sync with Stripe (if applicable)
            $subscriptionName = strtolower(preg_replace('/\s+/', '_', trim($plan->name)));
            $stripeSubscription = $user->subscription($subscriptionName);
            if ($stripeSubscription) {
                $stripeSubscription->swapAndInvoice($this->getExternalPriceID($plan));
                $stripeSubscription->update([
                    'type' => $subscriptionName
                ]);
            }

        // **2️⃣ Handle Downgrades (Scheduled, NOT Immediate)**
        } else if ($plan->level < $currentPlanItemUser->plan->level) {
            \Log::info("Downgrade scheduled for user ID: {$userID}, plan ID: {$planID}, effective after {$currentPlanItemUser->datetime_to}");

            // **Instead of downgrading now, schedule it**
            $currentPlanItemUser->update(['scheduled_downgrade_plan_id' => $planID]);

        // **3️⃣ Handle Plan Renewals**
        } else {
            \Log::info("Renewing existing plan for user ID: {$userID}");

            // Instead of creating a new entry, update existing one if possible
            if ($currentPlanItemUser) {
                $currentPlanItemUser->update(['datetime_to' => $datetimeTo]);
            } else {
                $this->createNewPlanItemUser($userID, $planID, $datetimeFrom, $datetimeTo);
            }
        }

        // Ensure the user's `plan_id` is updated
        $user->update(['plan_id' => $planID]);
    }


    /**
     * Create a new PlanItemUser entry.
     */
    public function createNewPlanItemUser($userID, $planID, $startDate, $endDate)
    {
        \Log::info("Creating new PlanItemUser for user ID: {$userID}, plan ID: {$planID}");

        // Expire any existing active plans
        PlanItemUser::where('user_id', $userID)->where('is_active', true)->update([
            'is_active' => false,
            'datetime_to' => Carbon::now(),
        ]);

        // Create new PlanItemUser
        return PlanItemUser::create([
            'datetime_from' => $startDate,
            'datetime_to' => $endDate,
            'is_active' => true,
            'plan_id' => $planID,
            'used_count' => 0,
            'user_id' => $userID,
        ]);
    }


    public function createSubscription($user, $planID, $paymentMethod = null)
    {
        $plan = Plan::findOrFail($planID);

        $this->paymentService->updateOrCreateStripeCustomer($user);
        $paymentMethod = $this->paymentService->getPaymentMethod($user, $paymentMethod);

        // **Check if the user already has an active plan**
        $currentPlanItemUser = $user->planItemUser()->with('plan')->where('is_active', true)->first();

        // **Find the current Stripe subscription (if exists)**
        $subscriptionName = strtolower(preg_replace('/\s+/', '_', trim($plan->name)));
        $currentSubscription = $user->subscription(strtolower(preg_replace('/\s+/', '_', trim($currentPlanItemUser->plan->name))));

        if ($currentPlanItemUser) {
            if ($plan->level > $currentPlanItemUser->plan->level && ($plan->is_required_payment && $currentPlanItemUser->plan->is_required_payment)) {
                // **Upgrade: Swap to new plan with prorated billing**
                \Log::info("User ID: {$user->id} upgrading to Plan ID: {$planID} with proration.");
                $currentSubscription->swapAndInvoice($this->getExternalPriceID($plan));
                $currentSubscription->update([
                    'type' => $subscriptionName
                ]);
            } else {
                // **Downgrade or new subscription: Create new plan subscription**
                \Log::info("User ID: {$user->id} subscribing to new plan ID: {$planID}.");
                $user->newSubscription($subscriptionName, $this->getExternalPriceID($plan))
                    ->create($paymentMethod->id);
            }
        } else {
            // **New user subscription**
            \Log::info("User ID: {$user->id} subscribing to Plan ID: {$planID} for the first time.");
            $user->newSubscription($subscriptionName, $this->getExternalPriceID($plan))
                ->create($paymentMethod->id);
        }

        // **Sync plan in the database after successful Stripe subscription**
        $this->syncPlan($user->id, $planID);

        return true;
    }

    public function scheduleDowngradeSubscription($user, $planID)
    {
        $currentPlanItemUser = $user->planItemUser()->with('plan')->where('is_active', true)->first();
        $nextPlan = Plan::findOrFail($planID);

        if($nextPlan->level > $currentPlanItemUser->plan->level) {
            throw new \Exception("Cannot downgrade to a plan with a higher level.");
        }

        if ($currentPlanItemUser) {
            if($nextPlan->is_required_payment) {
                $currentSubscription = $user->subscription(strtolower(preg_replace('/\s+/', '_', trim($currentPlanItemUser->plan->name))));

                $currentSubscription->swap($this->getExternalPriceID($nextPlan));
            }

            $currentPlanItemUser->update(['scheduled_downgrade_plan_id' => $planID]);
        }
    }


    /**
     * Calculate the next cycle end date based on the frequency of the plan item.
     */
    private function calculateEndDate($startDate, $planID)
    {
        $plan = Plan::findOrFail($planID);

        switch ($plan->renew_frequency) {
            case 'monthly':
                return Carbon::parse($startDate)->addMonths(1);
        }
    }

    /**
     * Sync all plan items for a user.
     */
    public function syncUserPlan($user)
    {
        $planItemUser = $user->planItemUser;

        // Get the current Stripe subscription for the user's plan
        if ($planItemUser) {
            $subscriptionName = strtolower(preg_replace('/\s+/', '_', trim($planItemUser->plan->name)));
            $stripeSubscription = $user->subscription($subscriptionName);
        } else {
            $stripeSubscription = null;
        }

        // Calculate grace period end date
        $gracePeriodEnd = $planItemUser ? Carbon::parse($planItemUser->datetime_to)->addDays($planItemUser->plan::GRACE_PERIOD_DAYS) : null;

        // If no active plan OR plan has expired
        if (!$planItemUser or !$planItemUser->plan or $planItemUser->datetime_to < Carbon::today()) {
            if ($gracePeriodEnd && $gracePeriodEnd >= Carbon::today()) {
                // Still within grace period → Keep plan active
                $planItemUser->update([
                    'is_active' => true,
                    'datetime_to' => $gracePeriodEnd,
                ]);
            } elseif (!$stripeSubscription || $stripeSubscription->canceled()) {
                // If grace period is over and no active Stripe subscription, downgrade to free plan
                $this->syncPlan($user->id, $this->getDefaultFreePlan()->id);
            } else {
                // Ensure the local database matches Stripe's subscription period
                $planItemUser->update([
                    'datetime_to' => Carbon::createFromTimestamp($stripeSubscription->current_period_end),
                ]);
            }
            return;
        }

        // Keep existing plan if everything is up to date
        $this->syncPlan($user->id, $planItemUser->plan_id);
    }



    private function getEnvironment()
    {
        return config('app.env');
    }
}
