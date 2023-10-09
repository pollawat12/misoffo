<?php 

use App\Http\Controllers\Office\Expenses\ExpenseController;
use App\Http\Controllers\Office\Expenses\ImportsController;
use App\Http\Controllers\Office\Expenses\CertificateController;
use App\Http\Controllers\Office\Expenses\IncomefinanceController;
use App\Http\Controllers\Office\Expenses\InstitutionController;
use App\Http\Controllers\Office\Expenses\FundController;
use App\Http\Controllers\Office\Expenses\IncomesController; 
use App\Http\Controllers\Office\Expenses\EstimateController;

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

    Route::get('project/get/projectDDl', [ExpenseController::class, 'getProjectDDl']);
    


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

    Route::prefix('income')->group(function () {

        Route::get('lists', [IncomefinanceController::class, 'index']);
        Route::get('add', [IncomefinanceController::class, 'create']);

        Route::get('view/{id}', [IncomefinanceController::class, 'view']);

        Route::get('edit/{id}', [IncomefinanceController::class, 'edit']);

        Route::post('save', [IncomefinanceController::class, 'store']);

        Route::post('update', [IncomefinanceController::class, 'update']);

        Route::get('deleted/{id}', [IncomefinanceController::class, 'destroy']);

        Route::get('import/lists', [IncomefinanceController::class, 'importform']);

        Route::post('import/save', [IncomefinanceController::class, 'importsave']);

    });


    Route::prefix('institution')->group(function () {

        Route::get('/lists', [InstitutionController::class, 'index']);
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

        Route::get('/loadbudget', [InstitutionController::class, 'loadbudget']);
        Route::get('/loadbudgetEdit/{id}/{num}', [InstitutionController::class, 'loadbudgetEdit']);
        Route::post('/subsave', [InstitutionController::class, 'substore']);
        Route::post('/subupdate', [InstitutionController::class, 'subupdate']);

        Route::get('/deleted/{id}', [InstitutionController::class, 'destroy']);

        Route::get('/loadbudgetAdd/{id}/{num}', [InstitutionController::class, 'loadbudgetAdd']);

    });

    Route::prefix('fund')->group(function () {

        Route::get('/lists', [FundController::class, 'index']);
        Route::get('/add', [FundController::class, 'create']);
        Route::post('/save', [FundController::class, 'store']);
        Route::get('/edit/{id}', [FundController::class, 'edit']);
        Route::post('/update', [FundController::class, 'update']);
        Route::get('/views/{id}/{insid}', [FundController::class, 'views']);
        Route::get('/all/{insid}', [FundController::class, 'viewsall']);

        Route::get('/deleted/{id}', [FundController::class, 'destroy']);

        Route::post('/year/subsave', [FundController::class, 'yearsubsave']);

        Route::get('imports/lists/{id}', [FundController::class, 'importform']);

        Route::post('imports/save', [FundController::class, 'importsave']);

        Route::get('/loadbudget', [FundController::class, 'loadbudget']);
        Route::get('/loadbudgetEdit/{id}/{num}', [FundController::class, 'loadbudgetEdit']);
        Route::post('/subsave', [FundController::class, 'substore']);
        Route::post('/subupdate', [FundController::class, 'subupdate']);

        Route::get('/deleted/{id}', [FundController::class, 'destroy']);

        Route::get('/loadbudgetAdd/{id}/{num}', [FundController::class, 'loadbudgetAdd']);

    });


    Route::prefix('fund')->group(function () {

        Route::get('/lists', [FundController::class, 'index']);
        Route::get('/add', [FundController::class, 'create']);
        Route::post('/save', [FundController::class, 'store']);
        Route::get('/edit/{id}', [FundController::class, 'edit']);
        Route::post('/update', [FundController::class, 'update']);
        Route::get('/views/{id}/{insid}', [FundController::class, 'views']);
        Route::get('/all/{insid}', [FundController::class, 'viewsall']);

        Route::get('/deleted/{id}', [FundController::class, 'destroy']);

        Route::post('/year/subsave', [FundController::class, 'yearsubsave']);

        Route::get('imports/lists/{id}', [FundController::class, 'importform']);

        Route::post('imports/save', [FundController::class, 'importsave']);

        Route::get('/loadbudget', [FundController::class, 'loadbudget']);
        Route::get('/loadbudgetEdit/{id}/{num}', [FundController::class, 'loadbudgetEdit']);
        Route::post('/subsave', [FundController::class, 'substore']);
        Route::post('/subupdate', [FundController::class, 'subupdate']);

        Route::get('/deleted/{id}', [FundController::class, 'destroy']);

        Route::get('/loadbudgetAdd/{id}/{num}', [FundController::class, 'loadbudgetAdd']);

    });


    Route::prefix('incomes')->group(function () {

        Route::get('/lists', [IncomesController::class, 'index']);
        Route::get('/add', [IncomesController::class, 'create']);
        Route::post('/save', [IncomesController::class, 'store']);
        Route::get('/edit/{id}', [IncomesController::class, 'edit']);
        Route::post('/update', [IncomesController::class, 'update']);
        Route::get('/views/{id}/{insid}', [IncomesController::class, 'views']);
        Route::get('/all/{insid}', [IncomesController::class, 'viewsall']);

        Route::get('/deleted/{id}', [IncomesController::class, 'destroy']);

        Route::post('/year/subsave', [IncomesController::class, 'yearsubsave']);

        Route::get('imports/lists/{id}', [IncomesController::class, 'importform']);

        Route::post('imports/save', [IncomesController::class, 'importsave']);

        Route::get('/loadbudget', [IncomesController::class, 'loadbudget']);
        Route::get('/loadbudgetEdit/{id}/{num}', [IncomesController::class, 'loadbudgetEdit']);
        Route::post('/subsave', [IncomesController::class, 'substore']);
        Route::post('/subupdate', [IncomesController::class, 'subupdate']);

        Route::get('/deleted/{id}', [IncomesController::class, 'destroy']);

        Route::get('/loadbudgetAdd/{id}/{num}', [IncomesController::class, 'loadbudgetAdd']);

    });

    Route::prefix('estimate')->group(function () {

        Route::get('/lists', [EstimateController::class, 'index']);
        Route::get('/add', [EstimateController::class, 'create']);
        Route::post('/save', [EstimateController::class, 'store']);
        Route::get('/edit/{id}', [EstimateController::class, 'edit']);
        Route::post('/update', [EstimateController::class, 'update']);
        Route::get('/views/{id}/{insid}', [EstimateController::class, 'views']);
        Route::get('/all/{insid}', [EstimateController::class, 'viewsall']);

        Route::get('/deleted/{id}', [EstimateController::class, 'destroy']);

        Route::post('/year/subsave', [EstimateController::class, 'yearsubsave']);

        Route::get('imports/lists/{id}', [EstimateController::class, 'importform']);

        Route::post('imports/save', [EstimateController::class, 'importsave']);

        Route::get('/loadbudget', [EstimateController::class, 'loadbudget']);
        Route::get('/loadbudgetEdit/{id}/{num}', [EstimateController::class, 'loadbudgetEdit']);
        Route::post('/subsave', [EstimateController::class, 'substore']);
        Route::post('/subupdate', [EstimateController::class, 'subupdate']);

        Route::get('/deleted/{id}', [EstimateController::class, 'destroy']);

        Route::get('/loadbudgetAdd/{id}/{num}', [EstimateController::class, 'loadbudgetAdd']);

    });

});