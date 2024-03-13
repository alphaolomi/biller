<?php

use App\Http\Controllers\Api\HouseBillController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
// Route::post('/register', [AuthController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::apiSingleton('/auth/profile', ProfileController::class);
    Route::prefix('me')->group(function () {
        Route::apiResource('houses', HouseBillController::class);
        Route::apiResource('houses.bills', HouseBillController::class);
        Route::apiResource('bills.attachments', HouseBillController::class)->shallow();
    });
});
