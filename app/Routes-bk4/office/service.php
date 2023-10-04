<?php

use App\Http\Controllers\Office\Services\ReservcarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\Services\ReservmeetingController;

Route::prefix('services')->namespace('Services')->group(function () {

    Route::prefix('reserve-meeting')->group(function () {
        Route::get('/', [ReservmeetingController::class, 'index']);
        Route::get('add', [ReservmeetingController::class, 'add']);
        Route::get('edit/{id}', [ReservmeetingController::class, 'edit']);
        Route::get('delete', [ReservmeetingController::class, 'delete']);
        Route::post('save', [ReservmeetingController::class, 'save']);
        Route::post('update', [ReservmeetingController::class, 'update']);
    });

    Route::prefix('reserve-car')->group(function () {
        Route::get('/', [ReservcarController::class, 'index']);
        Route::get('add', [ReservcarController::class, 'add']);
    });

    // Route::prefix('reserve-meeting')->group(function () {
    //     Route::get('/', [ReservmeetingController::class, 'index']);
    //     Route::get('add', [ReservmeetingController::class, 'add']);
    //     Route::get('edit/{id}', [ReservmeetingController::class, 'edit']);
    //     Route::get('delete', [ReservmeetingController::class, 'delete']);
    //     Route::get('save', [ReservmeetingController::class, 'save']);
    //     Route::get('update', [ReservmeetingController::class, 'update']);
    // });
});