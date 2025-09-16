<?php

use App\Http\Controllers\Api\PassengerShowController;
use App\Http\Controllers\Api\ReservationListController;
use App\Http\Controllers\Api\ReservationStatusController;
use App\Http\Controllers\Api\ReservationStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::prefix('passengers')->group(function() {
        Route::get('/{id}', PassengerShowController::class);
    });

    Route::prefix('reservations')->group(function() {
        Route::get('', ReservationListController::class);
        Route::post('', ReservationStoreController::class);
        Route::put('/{id}/status', ReservationStatusController::class);
    });
});
