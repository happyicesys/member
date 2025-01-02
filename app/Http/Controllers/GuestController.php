<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GuestController extends Controller
{


    public function about()
    {
        return Inertia::render('Guest/About');
    }

    public function home()
    {
        $plans = Plan::active()->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'plans' => PlanResource::collection($plans),
        ]);
    }

    public function privacyPolicy()
    {
        return Inertia::render('Guest/PrivacyPolicy');
    }

    public function termsAndConditions()
    {
        return Inertia::render('Guest/TermsAndConditions');
    }
}
