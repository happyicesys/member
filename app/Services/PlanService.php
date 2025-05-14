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
        // return $this->getDefaultPromoPlan();
        return Plan::findOrFail(1);
    }

    public function getGoldPlan()
    {
        return Plan::findOrFail(2);
    }


    public function getDefaultPromoPlan()
    {
        return Plan::findOrFail(2);
    }

    public function getExternalPriceID($plan)
    {
        if($this->isProduction()) {
            return $plan->external_ref_id;
        }else {
            return $plan->external_ref_test_id;
        }
    }

    public function syncPlan($userID, $planID, $extended_month_count = null)
    {
        $plan = Plan::findOrFail($planID);
        $user = User::findOrFail($userID);

        $currentPlanItemUser = PlanItemUser::where('user_id', $userID)
            ->where('is_active', true)
            ->latest()
            ->first();

        $renewFrequency = $plan->renew_frequency ?? 'monthly'; // Default to monthly
        $datetimeFrom = Carbon::now();
        $datetimeTo = $this->calculateEndDate($datetimeFrom, $planID, $extended_month_count);

        // **1️⃣ Handle Upgrades (Immediate Effect)**
        if (!$currentPlanItemUser || $plan->level > $currentPlanItemUser->plan->level || (!$currentPlanItemUser->plan->is_required_payment && $plan->is_required_payment)) {

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

            if($currentPlanItemUser->datetime_to < Carbon::now()) {
                $this->createNewPlanItemUser($userID, $planID, $datetimeFrom, $datetimeTo);
            }else {
                // **Downgrade: Schedule for later**
                $this->scheduleDowngradeSubscription($user, $planID);
            }

        // **3️⃣ Handle Plan Renewals**
        } else {
            $this->createNewPlanItemUser($userID, $planID, $datetimeFrom, $datetimeTo);
        }
    }

    /**
     * Create a new PlanItemUser entry.
     */
    public function createNewPlanItemUser($userID, $planID, $startDate, $endDate)
    {
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
                $currentSubscription->swapAndInvoice($this->getExternalPriceID($plan));
                $currentSubscription->update([
                    'type' => $subscriptionName
                ]);
            } else {
                // **Downgrade or new subscription: Create new plan subscription**
                $user->newSubscription($subscriptionName, $this->getExternalPriceID($plan))
                    ->create($paymentMethod->id);
            }
        } else {
            // **New user subscription**
            $user->newSubscription($subscriptionName, $this->getExternalPriceID($plan))
                ->create($paymentMethod->id);
        }

        // ✅ Check for successful activation
        $latestSubscription = $user->subscription($subscriptionName);

        if ($latestSubscription && $latestSubscription->active()) {
            if (!$user->is_converted) {
                $user->update([
                    'converted_at' => Carbon::now(),
                    'is_converted' => true,
                ]);
            }
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
            $currentSubscription = $user->subscription(strtolower(preg_replace('/\s+/', '_', trim($currentPlanItemUser->plan->name))));

            if($currentSubscription) {
                if($nextPlan->is_required_payment) {
                    $currentSubscription->swap($this->getExternalPriceID($nextPlan));
                }

                if(!$nextPlan->is_required_payment) {
                    $currentSubscription->cancel();
                }
            }

            $currentPlanItemUser->update(['scheduled_downgrade_plan_id' => $planID]);
        }
    }


    /**
     * Calculate the next cycle end date based on the frequency of the plan item.
     */
    private function calculateEndDate($startDate, $planID, $extended_month_count = null)
    {
        $plan = Plan::findOrFail($planID);

        if($extended_month_count) {
            return Carbon::parse($startDate)->addMonths($extended_month_count);
        }

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

        // Calculate grace period end date
        $gracePeriodEnd = $planItemUser ? Carbon::parse($planItemUser->datetime_to)->addDays(Plan::GRACE_PERIOD_DAYS) : null;

        // If no active plan OR plan has expired
        if($planItemUser) {
            if ($gracePeriodEnd && $gracePeriodEnd >= Carbon::now()) {
                // Still within grace period → Keep plan active
                $planItemUser->update([
                    'is_active' => true,
                    'datetime_to' => $gracePeriodEnd,
                ]);

            } elseif ($gracePeriodEnd < Carbon::now()) {
                // Grace period is over → Expire plan
                // If grace period is over and no active Stripe subscription, downgrade to free plan
                $scheduledDowngradePlanID = $planItemUser->scheduled_downgrade_plan_id;
                $scheduledDowngradePlan = Plan::find($scheduledDowngradePlanID);

                if($scheduledDowngradePlan and $scheduledDowngradePlan->is_required_payment and $user->hasPaymentMethod()) {
                    $this->syncPlan($user->id, $scheduledDowngradePlanID);

                    return;
                }

                if(!$scheduledDowngradePlan and $user->hasPaymentMethod()) {
                    $this->syncPlan($user->id, $planItemUser->plan_id);

                    return;
                }

                // Expire plan
                $this->syncPlan($user->id, $this->getDefaultFreePlan()->id);
            }

        }else {
            $this->syncPlan($user->id, $this->getDefaultPromoPlan()->id, 1);
        }
    }

    private function getEnvironment()
    {
        return config('app.env');
    }
}
