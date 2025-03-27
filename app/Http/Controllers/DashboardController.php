<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Country;
use App\Models\VendTransaction;
use App\Http\Resources\Api\V1\VendTransactionResource;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        return Inertia::render('AdminDashboard');
    }

    public function historyIndex()
    {
        $vendTransactions = VendTransaction::query()
            ->with(['vendTransactionItems'])
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(5);

        return Inertia::render('History', [
            'vendTransactions' => VendTransactionResource::collection($vendTransactions->get()),
            'transactedCountry' => CountryResource::make(Country::where('is_default', true)->first()),
        ]);
    }

    public function memberIndex()
    {
        // dd(Carbon::today()->addDays(-14)->toDateString());
        return Inertia::render('Dashboard');
    }
}
