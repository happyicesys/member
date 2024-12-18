<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/countries', )

Route::prefix('v1')->group(function () {
    Route::get('/countries', [CountryController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
