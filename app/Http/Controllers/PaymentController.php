<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Http\Resources\PlanItemUserResource;
use App\Http\Resources\UserResource;
use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\PlanItemUser;
use App\Services\PlanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    protected $planService;

    public function __construct()
    {
        $this->planService = new PlanService();
    }

    public function planIndex()
    {
        $user = auth()->user();

        return Inertia::render('Payment/Plan/Index', [
            'plans' => PlanResource::collection(Plan::active()->get()),
            'user' => UserResource::make($user),
            'planItemUser' => PlanItemUserResource::make($user->planItemUser()->with('plan')->first()),
            'userPaymentMethods' => $user->paymentMethods(),
            'userHasAnyPaymentMethod' => $user->hasDefaultPaymentMethod(),
            'needsPaymentMethod' => Plan::where('id', $user->plan_id)->value('is_required_payment'),
        ]);
    }

    public function paymentIndex()
    {
        // dd($this->getKey());
        return Inertia::render('Payment/Plan/Payment', [
            'plans' => PlanResource::collection(Plan::active()->get()),
            'planID' => request('plan_id'),
            'stripeKey' => $this->getKey(),
        ]);
    }

    public function storePaymentMethod(Request $request)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($request->plan_id);

        // Save payment method
        $user->addPaymentMethod($request->payment_method);
        if(!$user->hasDefaultPaymentMethod()) {
            $user->updateDefaultPaymentMethod($request->payment_method);
        }

        // Subscribe the user
        $user->newSubscription('default', $this->planService->getExternalPriceID($plan))
            ->create($user->defaultPaymentMethod()->id);

        // Associate the user with the plan (if applicable)
        $user->plan()->associate($plan);
        $user->save();

        return redirect()->route('plan.index')->with('success', 'Subscription successful!');
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($request->plan_id);
        $currentPlanItemUser = $user->planItemUser; // Get the latest plan item user

        // Check if the user is downgrading
        if ($currentPlanItemUser && $plan->level < $currentPlanItemUser->plan->level) {
            return redirect()->route('plan.retention', ['plan_id' => $plan->id]);
        }

        if (!$plan->is_required_payment) {
            // End the previous planItemUser if it exists
            if ($currentPlanItemUser) {
                $currentPlanItemUser->update([
                    'datetime_to' => Carbon::now(),
                    'is_active' => false,
                ]);
            }

            $this->planService->createNewPlanItemUser($user->id, $plan->id, Carbon::now());

            return redirect()->route('dashboard')->with('success', 'Subscription successful!');
        }

        // make sure user as stripe customer at first
        if (!$user->hasStripeId()) {
            $user->createAsStripeCustomer();
        }

        // Check if the user has a saved payment method
        if (!$user->hasDefaultPaymentMethod() and $request->payment_method) {
            $user->addPaymentMethod($request->payment_method);
            $user->updateDefaultPaymentMethod($request->payment_method);
        }

        // User has a payment method, proceed with subscription
        $user->newSubscription('default', $this->planService->getExternalPriceID($plan))
             ->create($user->defaultPaymentMethod()->id);

        // End the previous planItemUser if it exists
        if ($currentPlanItemUser) {
            $currentPlanItemUser->update([
                'datetime_to' => Carbon::now(),
                'is_active' => false,
            ]);
        }

        $this->planService->createNewPlanItemUser($user->id, $plan->id, Carbon::now());

        return redirect()->route('plan.index')->with('success', 'Subscription successful!');
    }


    public function retentionIndex(Request $request)
    {
        $user = auth()->user();
        $plans = Plan::all();
        $selectedPlan = $plans->find($request->plan_id);
        $currentPlanItemUser = $user->planItemUser()->with('plan')->first(); // Get the latest planItemUser

        // dd($selectedPlan, $currentPlanItemUser->toArray());

        return Inertia::render('Payment/Plan/Retention', [
            'selectedPlan' => PlanResource::make($selectedPlan),
            'currentPlanItemUser' => PlanItemUserResource::make($currentPlanItemUser),
        ]);
    }

    public function downgrade(Request $request)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($request->plan_id);

        if (!$plan) {
            return back()->withErrors(['message' => 'Invalid plan selected.']);
        }

        // Find the plan item associated with the new downgraded plan
        $plan = Plan::find($request->plan_id);
        if (!$plan) {
            return back()->withErrors(['message' => 'No plan item found for the selected plan.']);
        }

        // Get the user's latest planItemUser
        $currentPlanItemUser = $user->planItemUser()->latest()->first();

        if ($currentPlanItemUser) {
            // Set `datetime_to` to now for the existing plan
            $currentPlanItemUser->update([
                'datetime_to' => Carbon::now(),
                'is_active' => false,
            ]);
        }

        $this->planService->createNewPlanItemUser($user->id, $plan->id, Carbon::now());

        return redirect()->route('dashboard')->with('success', 'Your plan has been downgraded.');
    }

    public function getKey()
    {
        return config('cashier.key');
        // if(env('APP_ENV') === 'local') {
        //     return config('cashier.test_key');
        // }

        // if(env('APP_ENV') === 'production') {
        //     return config('cashier.key');
        // }
    }


}
