<?php 

use App\Http\Controllers\Office\Budgets\BudgetsController;
use App\Http\Controllers\Office\Budgets\SetController;
use App\Http\Controllers\Office\Budgets\InstitutionController;
use App\Http\Controllers\Office\Budgets\ExpenseController;

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
        Route::post('/update', [InstitutionController::class, 'update']);
        Route::get('/views/{id}/{insid}', [InstitutionController::class, 'views']);
        Route::get('/all/{insid}', [InstitutionController::class, 'viewsall']);

        Route::get('/deleted/{id}', [InstitutionController::class, 'destroy']);

        Route::post('/year/subsave', [InstitutionController::class, 'yearsubsave']);

        Route::get('imports/lists/{id}', [InstitutionController::class, 'importform']);

        Route::post('imports/save', [InstitutionController::class, 'importsave']);
    });

    Route::prefix('expenses')->group(function () {

        Route::get('/loadbudget', [ExpenseController::class, 'loadbudget']);
        Route::get('/loadbudgetEdit/{id}/{num}', [ExpenseController::class, 'loadbudgetEdit']);
        Route::post('/save', [ExpenseController::class, 'store']);
        Route::post('/update', [ExpenseController::class, 'update']);

        Route::get('/deleted/{id}', [ExpenseController::class, 'destroy']);

        Route::get('/loadbudgetAdd/{id}/{num}', [ExpenseController::class, 'loadbudgetAdd']);
    });

});