<?php 

use App\Http\Controllers\Office\Durable\DurableController;
use App\Http\Controllers\Office\Durable\DurablesettingController;
use App\Http\Controllers\Office\Durable\ImportsController;
use App\Http\Controllers\Office\Durable\ReportController;

Route::prefix('durable')->namespace('Durable')->group(function () {

    Route::get('lists', [DurableController::class, 'index']);
    Route::get('add', [DurableController::class, 'create']);
    Route::get('edit/{id}', [DurableController::class, 'edit']);
    Route::get('delete/{id}', [DurableController::class, 'destroy']);
    Route::get('report/{id}', [DurableController::class, 'report']);


    //amount
    Route::get('amount/{id}', [DurableController::class, 'amount']);
    Route::get('amount/add/{id}', [DurableController::class, 'amountCreate']);
    Route::get('amount/edit/{id}', [DurableController::class, 'amountEdit']);
    Route::get('amount/delete/{id}', [DurableController::class, 'amountDestroy']);
    Route::get('amount/report/{id}', [DurableController::class, 'amountReport']);
    Route::get('amount/detail/{id}', [DurableController::class, 'amountDetail']);
    Route::post('amount/save', [DurableController::class, 'activityStore']);

    Route::get('supplies/report/{id}', [DurableController::class, 'reportSupplies']);

    //amount
    Route::get('disbursement', [DurableController::class, 'disbursement']);
    Route::get('disbursement/add', [DurableController::class, 'disbursementCreate']);
    Route::post('disbursement/save', [DurableController::class, 'disbursementStore']);
    Route::get('disbursement/print/{id}', [DurableController::class, 'disbursementPrint']);


    //activity
    Route::get('activity', [DurableController::class, 'activity']);
    Route::get('activity/add', [DurableController::class, 'activityCreate']);
    Route::post('activity/save', [DurableController::class, 'activityUpdate']);
    Route::get('activity/edit/{id}', [DurableController::class, 'activityEdit']);
    Route::get('activity/delete/{id}', [DurableController::class, 'activityDestroy']);
    Route::get('activity/print/{id}', [DurableController::class, 'activityPrint']);
    Route::get('activity/search/list', [DurableController::class, 'searchAll']);


    // post
    Route::post('save', [DurableController::class, 'store']);
    Route::post('update', [DurableController::class, 'update']);
    

    //addresses
    Route::get('get/category', [DurableController::class, 'getCategory']);

    //repair
    Route::get('repair', [DurableController::class, 'repair']);
    Route::get('repair/add', [DurableController::class, 'repairCreate']);
    Route::get('repair/edit/{id}', [DurableController::class, 'repairEdit']);
    Route::get('repair/delete/{id}', [DurableController::class, 'repairDestroy']);
    Route::post('repair/save', [DurableController::class, 'repairStore']);

    
    
    // data 
    Route::prefix('data')->group(function () {
        Route::get('lists', [DurablesettingController::class, 'index']);
        Route::get('add', [DurablesettingController::class, 'create']);
        Route::get('edit/{id}', [DurablesettingController::class, 'edit']);
        Route::get('delete/{id}', [DurablesettingController::class, 'destroy']);

        // post
        Route::post('save', [DurablesettingController::class, 'store']);
        Route::post('update', [DurablesettingController::class, 'update']);


        //decline
        Route::get('get/decline', [DurablesettingController::class, 'info']);

        Route::post('decline/save', [DurablesettingController::class, 'savedecline']);

        //import
        // Route::get('import/lists', [DurablesettingController::class, 'importindex']);
        Route::get('import/lists', [DurablesettingController::class, 'importform']);
        Route::get('import/add', [DurablesettingController::class, 'importform']);

        Route::post('import/data', [ImportsController::class, 'invimport']);

    });

    // report 
    Route::prefix('reports')->group(function () {
        Route::get('lists', [ReportController::class, 'index']);
        Route::get('supplies/lists', [ReportController::class, 'index']);
    });
});