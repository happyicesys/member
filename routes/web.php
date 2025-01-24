<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

Route::get('/', [GuestController::class, 'home'])->name('home');

Route::get('/about', [GuestController::class, 'about'])->name('about');
Route::get('/contact-us', [GuestController::class, 'contactUs'])->name('contact-us');
Route::get('/history', [DashboardController::class, 'historyIndex'])->name('history');
Route::get('/join-licensee', [GuestController::class, 'joinLicensee'])->name('join-licensee');
Route::get('/data-protection-policy', [GuestController::class, 'dataProtectionPolicy'])->name('data-protection-policy');
Route::get('/privacy-policy', [GuestController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/privacy-policy-opn', [GuestController::class, 'privacyPolicyOpn'])->name('privacy-policy-opn');
Route::get('/terms-and-conditions', [GuestController::class, 'termsAndConditions'])->name('terms-and-conditions');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/benefit', function() {
        return Inertia::render('Benefit');
    })->name('benefit');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('plan')->group(function () {
        Route::get('/', [PaymentController::class, 'planIndex'])->name('plan.index');
    });
});

require __DIR__.'/auth.php';
