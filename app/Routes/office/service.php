<?php

use App\Http\Controllers\Office\Services\ReservcarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\Services\ReservmeetingController;

Route::prefix('services')->namespace('Services')->group(function () {

    Route::prefix('reserve-meeting')->group(function () {
        Route::get('/', [ReservmeetingController::class, 'index']);
        Route::get('add', [ReservmeetingController::class, 'add']);
        Route::get('edit/{id}', [ReservmeetingController::class, 'edit']);
        Route::post('delete', [ReservmeetingController::class, 'delete']);
        Route::post('save', [ReservmeetingController::class, 'save']);
        Route::post('update', [ReservmeetingController::class, 'update']);
    });

    Route::prefix('reserve-car')->group(function () {
        Route::get('/', [ReservcarController::class, 'index']);
        Route::get('add', [ReservcarController::class, 'add']);
        Route::get('edit/{id}', [ReservcarController::class, 'edit']);
        Route::post('delete', [ReservcarController::class, 'delete']);
        Route::post('save', [ReservcarController::class, 'save']);
        Route::post('update', [ReservcarController::class, 'update']);
        Route::get('report', [ReservcarController::class, 'report']);
        Route::get('print/{id}', [ReservcarController::class, 'print']);
    });

  
});