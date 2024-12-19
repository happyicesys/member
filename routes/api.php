<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/countries', )

Route::prefix('v1')->group(function () {
    Route::get('/countries', [CountryController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:3,1');

    Route::middleware('auth:api')->group(function () {
        Route::post('/user', [UserController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
