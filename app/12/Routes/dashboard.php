<?php 
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\StrategyController;
use App\Http\Controllers\Dashboard\AccountController;
use App\Http\Controllers\Dashboard\DurableController;
use App\Http\Controllers\Dashboard\PurchasesController;


Route::prefix('dashboard')->namespace('Dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    // budget

    // finance
    // account
    //dashboard/durable/create/data?data_type=data_state
    Route::get('account', [AccountController::class, 'index']);
    Route::get('account/create/data', [AccountController::class, 'generateReport']);

    // durable
    Route::get('durable', [DurableController::class, 'index']);
    Route::get('durable/create/data', [DurableController::class, 'generateReport']);

    // account
    Route::get('purchases', [PurchasesController::class, 'index']);

    // strategy
    Route::get('strategy', [StrategyController::class, 'index']);
    // hr
});