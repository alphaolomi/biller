<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillAttachmentController;
use App\Http\Controllers\Api\HouseBillController;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
// Route::post('/register', [AuthController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/auth/logout-all', [AuthController::class, 'logoutFromAllDevices'])->name('auth.logoutFromAllDevices');
    Route::apiSingleton('/auth/profile', ProfileController::class);
    Route::prefix('me')->group(function () {
        Route::apiResource('houses', HouseController::class);
        Route::apiResource('houses.bills', HouseBillController::class);
        Route::apiResource('bills.attachments', BillAttachmentController::class)->shallow();
    });
});
