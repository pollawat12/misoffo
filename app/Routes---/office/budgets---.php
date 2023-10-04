<?php 

use App\Http\Controllers\Office\Budgets\BudgetsController;
use App\Http\Controllers\Office\Budgets\SetController;
use App\Http\Controllers\Office\Budgets\InstitutionController;

Route::prefix('budgets')->namespace('Budgets')->group(function () {

    Route::get('/', [BudgetsController::class, 'index']);

    Route::prefix('set')->group(function () {

        Route::get('/{id}', [SetController::class, 'index']);
        Route::get('/get/info', [SetController::class, 'getinfo']);
        Route::post('/save', [SetController::class, 'store']);
        

    });

    Route::prefix('institution')->group(function () {

        Route::get('/', [InstitutionController::class, 'index']);
        Route::get('/add', [InstitutionController::class, 'create']);
        Route::post('/save', [InstitutionController::class, 'store']);
        Route::get('/edit/{id}', [InstitutionController::class, 'edit']);
        Route::get('/views/{id}/{insid}', [InstitutionController::class, 'views']);
        Route::get('/all/{insid}', [InstitutionController::class, 'viewsall']);

        Route::post('/year/subsave', [InstitutionController::class, 'yearsubsave']);

        Route::get('imports/lists/{id}', [InstitutionController::class, 'importform']);

        Route::post('imports/save', [InstitutionController::class, 'importsave']);
    });

});