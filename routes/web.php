<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

Route::get('/', [GuestController::class, 'home'])->name('home');

Route::get('/about', [GuestController::class, 'about'])->name('about');
Route::get('/contact-us', [GuestController::class, 'contactUs'])->name('contact-us');
Route::get('/privacy-policy', [GuestController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [GuestController::class, 'termsAndConditions'])->name('terms-and-conditions');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'planIndex'])->name('plan.index');
    });
});

require __DIR__.'/auth.php';
