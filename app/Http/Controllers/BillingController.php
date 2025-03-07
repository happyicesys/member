<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use App\Traits\HasCashier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BillingController extends Controller
{
    use HasCashier;

    public function index()
    {
        return Inertia::render('Billing/Index', [
            'allPaymentMethods' => PaymentMethodResource::collection(PaymentMethod::with('attachment')->get()),
            'defaultPaymentMethod' => auth()->user()->defaultPaymentMethod(),
            'invoices' => auth()->user()->invoices(),
            'stripeKey' => $this->getCashierKey(),
            'userPaymentMethods' => auth()->user()->paymentMethods(),
        ]);
    }

    public function downloadInvoice(Request $request, $externalInvoiceID)
    {
        // $user = auth()->user();

        // Assuming `downloadInvoice()` returns a path or stream
        return $request->user()->downloadInvoice($externalInvoiceID);
        // $invoice = $user->downloadInvoice($externalInvoiceID);

        // if (!$invoice) {
        //     return back()->with('error', 'Invoice not found.');
        // }

        // // Ensure $invoice is a valid path or response
        // return response()->download($invoice, "invoice-{$externalInvoiceID}.pdf");
    }
}
