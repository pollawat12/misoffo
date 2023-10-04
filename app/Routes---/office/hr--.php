<?php 

use App\Http\Controllers\Office\Hr\PersonalController;
use App\Http\Controllers\Office\Hr\CoursesController;
use App\Http\Controllers\Office\Hr\LeaveController;
use App\Http\Controllers\Office\Hr\DiagramController;
use App\Http\Controllers\Office\Hr\TimeattendanceController;
use App\Http\Controllers\Office\Hr\Setting\DefaultController;


Route::prefix('hr')->namespace('Hr')->group(function () {

    Route::get('employees', [PersonalController::class, 'index']);
    Route::get('employees/add/{id}', [PersonalController::class, 'create']);
    Route::get('employees/sub/add', [PersonalController::class, 'create2']);
    Route::get('employees/deleted/{id}/{userid}/{type}', [PersonalController::class, 'destroy']);
    Route::post('employees/sub/save', [PersonalController::class, 'substore']);
    Route::post('employees/save', [PersonalController::class, 'store']);

    Route::get('candidate', [PersonalController::class, 'indexCandidate']);


    // training
    Route::get('course', [CoursesController::class, 'index']);
    Route::get('course/add', [CoursesController::class, 'create']);
    Route::get('course/edit/{id}', [CoursesController::class, 'edit']);
    Route::get('course/deleted/{id}', [CoursesController::class, 'destroy']);

    Route::get('course/sub/{id}', [CoursesController::class, 'subindex']);
    Route::get('course/sub/deleted/{id}', [CoursesController::class, 'subdestroy']);

    Route::get('course/detail/{id}', [CoursesController::class, 'employeeindex']);


    //post training
    Route::post('course/save', [CoursesController::class, 'store']);
    Route::post('course/sub/save', [CoursesController::class, 'substore']);

    // salary
    Route::get('summary/leave/all', [PersonalController::class, 'index']);

    //addresses
    Route::get('employees/get/addresses', [PersonalController::class, 'getAddresses']);

    Route::get('employees/get/hrinfo', [PersonalController::class, 'hrinfo']);

    Route::get('employees/print/{id}', [PersonalController::class, 'employeesPrint']);


    Route::prefix('setting')->namespace('Setting')->group(function () {
        Route::get('default/', [DefaultController::class, 'index']);

        Route::get('holiday/{id}', [DefaultController::class, 'holiday']);

        Route::get('holiday/get/info', [DefaultController::class, 'holidayinfo']);
        Route::get('holiday/save', [DefaultController::class, 'holidaystore']);
        Route::get('holiday/deleted/{id}', [DefaultController::class, 'holidaydestroy']);

    });


    // leave Form
    Route::get('leave/all', [LeaveController::class, 'all']);
    Route::get('leave/sub/{id}', [LeaveController::class, 'index']);
    Route::get('leave/add/{id}/{typeid}', [LeaveController::class, 'create']);
    Route::get('leave/edit/{id}', [LeaveController::class, 'edit']);
    Route::get('leave/deleted/{id}', [LeaveController::class, 'destroy']);
    Route::get('leave/search/list', [LeaveController::class, 'searchAll']);

    Route::get('leave/get/info', [LeaveController::class, 'info']);

    Route::post('leave/sub/save', [LeaveController::class, 'substore']);

    Route::get('leave/get/decline', [LeaveController::class, 'leavedecline']);

    Route::post('leave/decline/save', [LeaveController::class, 'savedecline']);


    // leave-work Form
    Route::get('leave-work/all', [LeaveController::class, 'workall']);
    Route::get('leave-work/{id}', [LeaveController::class, 'workindex']);
    Route::get('leave-work/get/info', [LeaveController::class, 'workinfo']);

    Route::post('leave-work/save', [LeaveController::class, 'workstore']);

    // diagram Form
    Route::get('diagram/all', [DiagramController::class, 'index']);

    Route::get('diagram/sub/{id}', [DiagramController::class, 'indexSub']);

    Route::get('diagram/get/info', [DiagramController::class, 'info']);

    Route::post('diagram/save', [DiagramController::class, 'store']);

    Route::get('diagram/deleted/{id}', [DiagramController::class, 'destroy']);

    Route::prefix('time_attendances')->group(function () {
        Route::get('/', [TimeattendanceController::class, 'index']);
        Route::get('import_form/add', [TimeattendanceController::class, 'add']);
        Route::post('import_form/save', [TimeattendanceController::class, 'save']);
    });

});