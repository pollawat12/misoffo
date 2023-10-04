<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\BudgetController;
use App\Http\Controllers\Dashboard\AccountController;
use App\Http\Controllers\Dashboard\DurableController;
use App\Http\Controllers\Dashboard\StrategyController;
use App\Http\Controllers\Dashboard\PurchasesController;


Route::prefix('dashboard')->namespace('Dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    // budget
    Route::get('budget', [BudgetController::class, 'index']);
    Route::get('budget/create/data', [BudgetController::class, 'generateReport']);

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
    Route::post('strategy/load', [StrategyController::class, 'strategyLoad']);
    // hr
});