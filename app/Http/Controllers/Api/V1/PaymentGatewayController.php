<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PaymentGatewayWebhookLog;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function createWebhookLog(Request $request)
    {
        PaymentGatewayWebhookLog::create([
            'original_json' => $request->all(),
            'status' => 1
        ]);

        return true;
    }
}
