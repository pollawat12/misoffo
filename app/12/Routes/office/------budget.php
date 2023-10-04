<?php 

use App\Http\Controllers\Office\Budget\DebterController;
use App\Http\Controllers\Office\Budget\ExpenseController;
use App\Http\Controllers\Office\Budget\ExportController;
use App\Http\Controllers\Office\Budget\FeeconfirmController;
use App\Http\Controllers\Office\Budget\ImportsController;
use App\Http\Controllers\Office\Budget\InvoiceController;
use App\Http\Controllers\Office\Budget\Report\IncomeController;

Route::prefix('budget')->namespace('Budget')->group(function () {

    Route::prefix('import')->group(function () {
        // invoice
        Route::post('invoice/data', [ImportsController::class, 'invimport']);
        Route::post('invoice/update/data', [ImportsController::class, 'updateinvimport']);

        // report data for dashboard
        Route::get('report/to/dashboard', [ImportsController::class, 'updatedashboard']);
    });

    Route::prefix('debtors')->group(function () {

        Route::get('all', [DebterController::class, 'index']);
        Route::get('sub/all/{id}', [DebterController::class, 'index']);
        Route::get('import-form/new', [DebterController::class, 'importform']);
        Route::get('import-form/update/item/delete', [DebterController::class, 'destroyitem']);
        Route::get('import-form/update/{num}', [DebterController::class, 'importformupdate']);//debtors/form-update

        Route::get('import-form/update/item/edit/{num}', [DebterController::class, 'edititem']);
        Route::post('import-form/update/item/edit/save', [DebterController::class, 'edititemsave']);

        Route::get('delete/{id}', [DebterController::class, 'destroy']);
    });

    Route::prefix('expenses')->group(function () {

        //bugget year
        Route::get('all', [ExpenseController::class, 'budget']);
        Route::get('charges/{id}', [ExpenseController::class, 'budgetshow']);
        Route::get('charges/add/{id}', [ExpenseController::class, 'budgetcreate']);
        Route::get('charges/edit/{id}/{projectsId}', [ExpenseController::class, 'budgetdedit']);
        Route::get('charges/deleted/{id}', [ExpenseController::class, 'budgetdestroy']);
        Route::get('reposts', [ExpenseController::class, 'budgetrepost']);
        Route::get('reposts/{id}', [ExpenseController::class, 'budgetrepost']);

        //project
        Route::get('/', [ExpenseController::class, 'all']);
        Route::get('show/{id}', [ExpenseController::class, 'index']);
        Route::get('add/{id}', [ExpenseController::class, 'create']);
        Route::get('print/{id}', [ExpenseController::class, 'printing']);
        Route::get('edit/{id}/{projectsId}', [ExpenseController::class, 'edit']);
        Route::get('detail/{id}/{projectsId}', [ExpenseController::class, 'detail']);
        Route::get('deleted/{id}', [ExpenseController::class, 'destroy']);
        Route::get('view/{id}/{projectsId}', [ExpenseController::class, 'show']);

        Route::get('get/buginfo', [ExpenseController::class, 'buginfo']);

        //project New
        Route::get('project', [ExpenseController::class, 'projectall']);
        Route::get('project/add', [ExpenseController::class, 'projectcreate']);
        Route::get('project/edit/{id}', [ExpenseController::class, 'projectedit']);
        Route::get('project/deleted/{id}', [ExpenseController::class, 'projectdestroy']);

        Route::post('project/save', [ExpenseController::class, 'projectstore']);
        Route::post('project/update', [ExpenseController::class, 'projectupdate']);

        Route::get('project/get/info', [ExpenseController::class, 'getProject']);

        // post
        Route::post('save', [ExpenseController::class, 'store']);
        Route::post('update', [ExpenseController::class, 'update']);
        Route::post('bugSave', [ExpenseController::class, 'bugSave']);

        //Year
        Route::get('year/lists', [ExpenseController::class, 'yearlists']);
        Route::get('year/{id}', [ExpenseController::class, 'year']);
        Route::get('year/add/new', [ExpenseController::class, 'yearAdd']);
        Route::get('year/show/{id}', [ExpenseController::class, 'yearShow']);
        Route::get('year/edit/{id}', [ExpenseController::class, 'yearEdit']);
        Route::get('year/delete/{id}', [ExpenseController::class, 'yearDelete']);

        //Year post
        Route::post('year/save', [ExpenseController::class, 'yearsave']);

        //import
        Route::get('import/lists', [ExpenseController::class, 'importindex']);
        Route::get('import/add', [ExpenseController::class, 'importform']);

        Route::get('import/data', [ImportsController::class, 'expensesimport']);
    });

    Route::prefix('confirm')->group(function () {
        Route::get('all', [FeeconfirmController::class, 'index']);
        Route::get('show/{id}', [FeeconfirmController::class, 'show']);
        Route::get('add/{id}', [FeeconfirmController::class, 'create']);
        Route::get('edit/{id}/{projectsId}', [FeeconfirmController::class, 'edit']);
        Route::get('delete/{id}/{projectsId}', [FeeconfirmController::class, 'destroy']);
        Route::get('view/{id}/{projectsId}', [FeeconfirmController::class, 'views']);

        // post
        Route::post('save', [FeeconfirmController::class, 'store']);
        Route::post('update', [FeeconfirmController::class, 'update']);
    });


    Route::prefix('report')->group(function () {
        Route::get('income/all', [IncomeController::class, 'index']);
        Route::get('income/view/all', [IncomeController::class, 'indexexport']);
        Route::get('income/form/create', [IncomeController::class, 'formcreate']);
        Route::get('income/search/all', [IncomeController::class, 'searchall']);
    });

});