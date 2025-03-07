<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

// auth()->loginUsingId(1);

Route::get('/', [GuestController::class, 'home'])->name('home');

Route::get('/about', [GuestController::class, 'about'])->name('about');
Route::get('/contact-us', [GuestController::class, 'contactUs'])->name('contact-us');
Route::get('/history', [DashboardController::class, 'historyIndex'])->name('history');
Route::get('/join-licensee', [GuestController::class, 'joinLicensee'])->name('join-licensee');
Route::get('/data-protection-policy', [GuestController::class, 'dataProtectionPolicy'])->name('data-protection-policy');
Route::get('/privacy-policy', [GuestController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/privacy-policy-opn', [GuestController::class, 'privacyPolicyOpn'])->name('privacy-policy-opn');
Route::get('/terms-and-conditions', [GuestController::class, 'termsAndConditions'])->name('terms-and-conditions');


Route::middleware('auth')->group(function () {

    Route::get('/benefit', function() {
        return Inertia::render('Benefit');
    })->name('benefit');

    Route::prefix('billing')->group(function() {
        Route::get('/', [BillingController::class, 'index'])->name('billing');
        Route::get('/download-invoice/{externalInvoiceID}', [BillingController::class, 'downloadInvoice'])->name('billing.download-invoice');
    });

    Route::get('/dashboard', [DashboardController::class, 'memberIndex'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/dashboard-admin', [DashboardController::class, 'adminIndex'])->name('dashboard.admin');

    Route::prefix('payment-methods')->group(function() {
        Route::post('/store', [PaymentMethodController::class, 'store'])->name('payment-methods.store');
        Route::put('/payment-methods/{id}/set-default', [PaymentMethodController::class, 'setDefault'])->name('payment-methods.set-default');
        Route::delete('/payment-methods/{externalPaymentMethodID}', [PaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');
    });

    Route::prefix('plan')->group(function () {
        Route::get('/', [PaymentController::class, 'planIndex'])->name('plan.index');
        Route::post('/subscribe', [PaymentController::class, 'subscribe'])->name('plan.subscribe');
        Route::get('/payment', [PaymentController::class, 'paymentIndex'])->name('plan.payment');
        Route::get('/retention', [PaymentController::class, 'retentionIndex'])->name('plan.retention');
        Route::post('/downgrade', [PaymentController::class, 'downgrade'])->name('plan.downgrade');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
