<?php 

use App\Http\Controllers\Office\Incomes\Setting\OilController;
use App\Http\Controllers\Office\Incomes\Setting\CompanyController;
use App\Http\Controllers\Office\Incomes\IncomesController;


Route::prefix('incomes')->namespace('Incomes')->group(function () {

    Route::get('lists', [IncomesController::class, 'index']);
    Route::get('add', [IncomesController::class, 'create']);
    Route::get('edit/{id}', [IncomesController::class, 'edit']);
    Route::get('delete/{id}', [IncomesController::class, 'destroy']);
    Route::post('save', [IncomesController::class, 'store']);
    Route::post('update', [IncomesController::class, 'update']);
    Route::get('reports', [IncomesController::class, 'reports']);

    Route::prefix('settings')->group(function () {

        Route::prefix('oil')->group(function () {
            Route::get('lists', [OilController::class, 'index']);
            Route::get('add', [OilController::class, 'create']);
            Route::get('edit/{id}', [OilController::class, 'edit']);
            Route::get('delete/{id}', [OilController::class, 'destroy']);
            Route::post('save', [OilController::class, 'store']);
            Route::post('update', [OilController::class, 'update']);
        });


        Route::prefix('company')->group(function () {
            Route::get('lists', [CompanyController::class, 'index']);
            Route::get('add', [CompanyController::class, 'create']);
            Route::get('edit/{id}', [CompanyController::class, 'edit']);
            Route::get('delete/{id}', [CompanyController::class, 'destroy']);
            Route::post('save', [CompanyController::class, 'store']);
            Route::post('update', [CompanyController::class, 'update']);
        });
        
    });

});