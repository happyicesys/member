<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Http\Resources\UserResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function planIndex()
    {
        $plans = Plan::active()->get();
        $user = auth()->user();

        return Inertia::render('Payment/Plan/Index', [
            'plans' => PlanResource::collection($plans),
            'user' => UserResource::make($user),
            'selectedPlan' => $user->plan,
        ]);
    }
}
