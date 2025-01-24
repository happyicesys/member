<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Models\User;
use App\Services\MapService;
use App\Services\SysApiService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->mapService = new MapService();
        $this->sysApiService = new SysApiService();
    }

    public function about()
    {
        return Inertia::render('Guest/About');
    }

    public function contactUs()
    {
        return Inertia::render('Guest/ContactUs');
    }

    public function dataProtectionPolicy()
    {
        return Inertia::render('Guest/DataProtectionPolicy');
    }

    public function home()
    {
        $plans = Plan::active()->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'dcvends' => $this->sysApiService->getAllDCVends(env('SYS_OPERATOR_CODE')),
            // 'dcvends' => [],
            'laravelVersion' => Application::VERSION,
            'mapApiKey' => $this->mapService->getMapApiKey(),
            'phpVersion' => PHP_VERSION,
            'plans' => PlanResource::collection($plans),
            'stats' => $this->stats(),
        ]);
    }

    public function joinLicensee()
    {
        return Inertia::render('Guest/JoinLicensee');
    }

    public function privacyPolicy()
    {
        return Inertia::render('Guest/PrivacyPolicy');
    }

    public function privacyPolicyOpn()
    {
        return Inertia::render('Guest/PrivacyPolicyOpn');
    }

    public function stats()
    {
        return [
            'users' => 1000 + User::count(),
            'discount' => 25,
        ];
    }

    public function termsAndConditions()
    {
        return Inertia::render('Guest/TermsAndConditions');
    }
}
