<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\VendTransaction;
use App\Http\Resources\Api\V1\VendTransactionResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function historyIndex()
    {
        Auth::loginUsingId(73);

        $vendTransactions = VendTransaction::query()
            ->with(['vendTransactionItems'])
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(5);

        return Inertia::render('History', [
            'vendTransactions' => VendTransactionResource::collection($vendTransactions->get()),
        ]);
    }
}
