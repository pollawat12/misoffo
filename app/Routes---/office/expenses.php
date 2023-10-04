<?php 

use App\Http\Controllers\Office\Expenses\ExpenseController;
use App\Http\Controllers\Office\Expenses\ImportsController;
use App\Http\Controllers\Office\Expenses\CertificateController;

Route::prefix('expenses')->namespace('expenses')->group(function () {

    //bugget year
    Route::get('all', [ExpenseController::class, 'budget']);
    Route::get('charges/{id}', [ExpenseController::class, 'budgetshow']);
    Route::get('charges/add/{id}', [ExpenseController::class, 'budgetcreate']);
    Route::get('charges/edit/{id}/{projectsId}', [ExpenseController::class, 'budgetdedit']);
    Route::get('charges/deleted/{id}', [ExpenseController::class, 'budgetdestroy']);
    Route::get('reposts', [ExpenseController::class, 'budgetrepost']);
    Route::get('reposts/{id}', [ExpenseController::class, 'budgetrepost']);

    Route::get('compensate/all', [ExpenseController::class, 'budgetcompensate']);
    Route::get('compensate/add/{id}', [ExpenseController::class, 'budgetcompensatecreate']);
    Route::post('compensate/save', [ExpenseController::class, 'compensatestore']);

    Route::get('compensate/edit/{id}', [ExpenseController::class, 'budgetcompensateedit']);
    Route::post('compensate/update', [ExpenseController::class, 'compensateupdate']);

    Route::get('compensate/deleted/{id}', [ExpenseController::class, 'compensatedestroy']);

    // Route::get('export/{id}', [ExpenseController::class, 'budgetexport']);
    //export
    Route::get('export/{id}', [ExportController::class, 'budgetexport']);

    Route::get('loadproject/{id}/{yearId}', [ExpenseController::class, 'budgetloadproject']);
    Route::get('loadtype/{id}/{yearId}', [ExpenseController::class, 'budgetloadtype']);
    Route::get('loadtype1/{id}/{yearId}', [ExpenseController::class, 'budgetloadtype1']);
    Route::get('loadtype2/{id}/{yearId}', [ExpenseController::class, 'budgetloadtype2']);

    Route::get('loadprojectpurchase/{id}/{yearId}', [ExpenseController::class, 'loadprojectpurchase']);

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

    Route::get('project/getNew/info', [ExpenseController::class, 'getProjectNew']);

    // post
    Route::post('save', [ExpenseController::class, 'store']);
    Route::post('update', [ExpenseController::class, 'update']);
    Route::post('bugSave', [ExpenseController::class, 'bugSave']);

    //Year
    Route::get('year/lists', [ExpenseController::class, 'yearlists']);
    Route::get('year/{id}/{institutionId}', [ExpenseController::class, 'year']);
    Route::get('year/add/get/new', [ExpenseController::class, 'yearAdd']);
    Route::get('year/show/{id}', [ExpenseController::class, 'yearShow']);
    Route::get('year/edit/get/{id}', [ExpenseController::class, 'yearEdit']);
    Route::get('year/repost/get/{id}/{institutionId}', [ExpenseController::class, 'yearRepost']);
    Route::get('year/loadcategory/{id}/{num}/{title}', [ExpenseController::class, 'yearLoadcategory']);
    Route::get('year/load/get/loadbudget', [ExpenseController::class, 'yearLoadbudget']);
    Route::get('year/delete/{id}', [ExpenseController::class, 'yearDelete']);
    Route::get('year/load/get/loaddate/{id}/{yearid}/{num}', [ExpenseController::class, 'yearLoaddate']);

    Route::get('years/reposts/lists', [ExpenseController::class, 'yearRepostLists']);

    Route::get('year/repost/export/{id}/{institutionId}', [ExportController::class, 'yearRepostExport']);

    //Year post
    Route::post('year/save', [ExpenseController::class, 'yearsave']);
    Route::post('year/subsave', [ExpenseController::class, 'yearsubsave']);

    //import
    Route::get('import/lists', [ExpenseController::class, 'importindex']);
    Route::get('import/add', [ExpenseController::class, 'importform']);

    Route::get('import/data', [ImportsController::class, 'expensesimport']);

    Route::prefix('certificate')->group(function () {

        Route::get('all', [CertificateController::class, 'index']);
        Route::get('add', [CertificateController::class, 'create']);
        Route::get('get/loadDetail/{id}/{typeid}', [CertificateController::class, 'loadDetail']);

        Route::get('view/{id}', [CertificateController::class, 'view']);

        Route::get('edit/{id}', [CertificateController::class, 'edit']);

        Route::post('save', [CertificateController::class, 'store']);

        Route::post('update', [CertificateController::class, 'update']);

        Route::get('get/info', [CertificateController::class, 'getinfo']);

        Route::get('company', [CertificateController::class, 'companyindex']);
        Route::get('company/add', [CertificateController::class, 'companycreate']);

        Route::post('company/save', [CertificateController::class, 'companystore']);

        Route::get('company/edit/{id}', [CertificateController::class, 'companyedit']);

        Route::post('company/update', [CertificateController::class, 'companyupdate']);
    });

});