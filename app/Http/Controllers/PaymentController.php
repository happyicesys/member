<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PlanResource;
use App\Http\Resources\PlanItemUserResource;
use App\Http\Resources\UserResource;
use App\Models\PaymentMethod;
use App\Models\Plan;
use App\Models\PlanItemUser;
use App\Services\PlanService;
use App\Traits\HasCashier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    use HasCashier;

    protected $planService;

    public function __construct()
    {
        $this->planService = new PlanService();
    }

    public function planIndex()
    {
        $user = auth()->user();

        return Inertia::render('Payment/Plan/Index', [
            'allPaymentMethods' => PaymentMethodResource::collection(PaymentMethod::with('attachment')->get()),
            'plans' => PlanResource::collection(Plan::active()->get()),
            'user' => UserResource::make($user),
            'planItemUser' => PlanItemUserResource::make($user->planItemUser()->with(['plan', 'scheduledDowngradePlan'])->first()),
            'userPaymentMethods' => $user->paymentMethods(),
            'userHasAnyPaymentMethod' => $user->hasDefaultPaymentMethod(),
            'needsPaymentMethod' => Plan::where('id', $user->plan_id)->value('is_required_payment'),
        ]);
    }

    public function paymentIndex()
    {
        return Inertia::render('Payment/Plan/Payment', [
            'plans' => PlanResource::collection(Plan::active()->get()),
            'planID' => request('plan_id'),
            'stripeKey' => $this->getCashierKey(),
        ]);
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($request->plan_id);
        $currentPlanItemUser = $user->planItemUser()->with('plan')->first();

        \Log::info("User ID: {$user->id} attempting to subscribe to Plan ID: {$plan->id}");

        // **1️⃣ Handle Downgrade: Redirect to Retention Page Before Proceeding**
        if ($currentPlanItemUser && $plan->level < $currentPlanItemUser->plan->level) {
            \Log::info("User ID: {$user->id} is downgrading to Plan ID: {$plan->id}. Redirecting to retention page.");
            return redirect()->route('plan.retention', ['plan_id' => $plan->id]);
        }

        // **2️⃣ Handle Free Plans (No Payment Required)**
        if (!$plan->is_required_payment) {
            \Log::info("User ID: {$user->id} subscribing to a free plan. Ending previous plan (if exists).");

            if ($currentPlanItemUser) {
                $currentPlanItemUser->update([
                    'datetime_to' => Carbon::now(),
                    'is_active' => false,
                ]);
            }

            $this->planService->createNewPlanItemUser($user->id, $plan->id, Carbon::now());

            return redirect()->route('dashboard')->with('success', 'Subscription successful!');
        }

        // **3️⃣ Ensure User Has a Default Payment Method Before Proceeding**
        if (!$request->payment_method and !$user->hasDefaultPaymentMethod()) {
            \Log::warning("User ID: {$user->id} has no default payment method. Prompting for payment details.");
            return back()->withErrors(['message' => 'Please add a payment method before subscribing.']);
        }

        // **4️⃣ Process Stripe Subscription**
        // try {
            // \Log::info("User ID: {$user->id} subscribing to a paid plan. Processing Stripe subscription.");
            $this->planService->createSubscription($user, $plan->id, $request->payment_method);
        // } catch (\Exception $e) {
        //     \Log::error("Subscription failed for User ID: {$user->id}. Error: " . $e->getMessage());
        //     return back()->withErrors(['message' => 'Subscription failed. Please check your billing details.']);
        // }

        \Log::info("Subscription successful for User ID: {$user->id}, Plan ID: {$plan->id}.");

        return redirect()->route('plan.index')->with('success', 'Subscription successful!');
    }

    public function retentionIndex(Request $request)
    {
        $user = auth()->user();
        $plans = Plan::all();
        $selectedPlan = Plan::findOrFail($request->plan_id);
        $currentPlanItemUser = $user->planItemUser()->with('plan')->first();

        \Log::info("Displaying retention page for user ID: {$user->id}, downgrading to plan ID: {$selectedPlan->id}");

        return Inertia::render('Payment/Plan/Retention', [
            'selectedPlan' => PlanResource::make($selectedPlan),
            'currentPlanItemUser' => PlanItemUserResource::make($currentPlanItemUser),
        ]);
    }

    public function downgrade(Request $request)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($request->plan_id);

        $this->planService->scheduleDowngradeSubscription($user, $plan->id);

        return redirect()->route('plan.index')->with('success', 'Your downgrade has been scheduled.');
    }

    public function getKey()
    {
        return config('cashier.key');
    }
}
