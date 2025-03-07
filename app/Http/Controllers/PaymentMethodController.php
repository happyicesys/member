<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    protected $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->paymentService->updateOrCreateStripeCustomer(auth()->user());
        $this->paymentService->getPaymentMethod(auth()->user(), $request->payment_method);
    }

    // set selected payment method as default
    public function setDefault(Request $request, $id)
    {
        $user = auth()->user();

        // Set as default in Stripe
        $this->paymentService->setDefaultPaymentMethod($user, $request->external_method_id);

        // Fetch updated default payment method
        $updatedDefaultPaymentMethod = $user->defaultPaymentMethod();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($externalPaymentMethodID)
    {
        $user = auth()->user();

        $user->findPaymentMethod($externalPaymentMethodID)->delete();

        if(!$user->hasDefaultPaymentMethod() and $user->hasPaymentMethod()) {
            $this->paymentService->setDefaultPaymentMethod($user);
        }

        return back();
    }
}
