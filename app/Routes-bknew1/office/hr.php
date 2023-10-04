<?php 

use App\Http\Controllers\Office\Hr\PersonalController;
use App\Http\Controllers\Office\Hr\CoursesController;
use App\Http\Controllers\Office\Hr\LeaveController;
use App\Http\Controllers\Office\Hr\DiagramController;
use App\Http\Controllers\Office\Hr\TimeattendanceController;
use App\Http\Controllers\Office\Hr\InterviewController;
use App\Http\Controllers\Office\Hr\AnnounceController;
use App\Http\Controllers\Office\Hr\JobsController;
use App\Http\Controllers\Office\Hr\CandidateController;
use App\Http\Controllers\Office\Hr\EstimateController;
use App\Http\Controllers\Office\Hr\EstimateEmployeesController;
use App\Http\Controllers\Office\Hr\BehaviorEmployeesController;
use App\Http\Controllers\Office\Hr\BenefitsController;
use App\Http\Controllers\Office\Hr\Setting\DefaultController;
use App\Http\Controllers\Office\Hr\ChangepassController;
use App\Http\Controllers\Office\Hr\Setting\TimeattendanceController as SettingTimeattendanceController;

Route::prefix('hr')->namespace('Hr')->group(function () {

    Route::get('employees', [PersonalController::class, 'index']);
    Route::get('employees/add/{id}', [PersonalController::class, 'create']);
    Route::get('employees/sub/add', [PersonalController::class, 'create2']);
    Route::get('employees/deleted/{id}/{userid}/{type}', [PersonalController::class, 'destroy']);
    Route::post('employees/sub/save', [PersonalController::class, 'substore']);
    Route::post('employees/save', [PersonalController::class, 'store']);

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

    Route::get('employees/views/{usersid}/{id}', [PersonalController::class, 'employeesviews']);

    Route::get('employees/print/{usersid}/{id}', [PersonalController::class, 'employeesPrint']);

    Route::prefix('setting')->namespace('Setting')->group(function () {
        Route::get('default/', [DefaultController::class, 'index']);

        Route::get('holiday/{id}', [DefaultController::class, 'holiday']);

        Route::get('holiday/get/info', [DefaultController::class, 'holidayinfo']);
        Route::get('holiday/save', [DefaultController::class, 'holidaystore']);
        Route::get('holiday/deleted/{id}', [DefaultController::class, 'holidaydestroy']);

        // -- add time attendance setting -- //
        Route::get('time-attendance', [SettingTimeattendanceController::class, 'index']);
        Route::post('time-attendance/update', [SettingTimeattendanceController::class, 'update']);
    });


    // leave Form
    Route::get('leave/all', [LeaveController::class, 'all']);
    Route::get('leave/departments/{id}/{depid}', [LeaveController::class, 'departments']);
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

    Route::prefix('interview')->namespace('Interview')->group(function () {
        Route::get('lists', [InterviewController::class, 'index']);
        Route::get('add', [InterviewController::class, 'create']);
        Route::get('edit/{id}', [InterviewController::class, 'edit']);
        Route::get('delete/{id}', [InterviewController::class, 'destroy']);
        Route::get('report/{id}', [InterviewController::class, 'report']);
    });

    Route::prefix('announce')->namespace('Announce')->group(function () {
        Route::get('/', [AnnounceController::class, 'index']);
        Route::get('add', [AnnounceController::class, 'create']);
        Route::get('edit/{id}', [AnnounceController::class, 'edit']);
        Route::get('delete/{id}', [AnnounceController::class, 'destroy']);
        Route::get('views/{id}', [AnnounceController::class, 'report']);

        // post
        Route::post('save', [AnnounceController::class, 'store']);
        Route::post('update', [AnnounceController::class, 'update']);
    });

    Route::prefix('jobs')->namespace('Jobs')->group(function () {
        Route::get('/{id}', [JobsController::class, 'index']);
        Route::get('add/{id}', [JobsController::class, 'create']);
        Route::get('edit/{id}', [JobsController::class, 'edit']);
        Route::get('delete/{id}', [JobsController::class, 'destroy']);
        Route::get('views/{id}', [JobsController::class, 'report']);

        // post
        Route::post('save', [JobsController::class, 'store']);
        Route::post('update', [JobsController::class, 'update']);
    });

    Route::prefix('candidate')->namespace('Candidate')->group(function () {
        Route::get('/', [CandidateController::class, 'index']);
        Route::get('add/{id}', [CandidateController::class, 'create']);
        Route::get('edit/{id}', [CandidateController::class, 'edit']);
        Route::get('delete/{id}', [CandidateController::class, 'destroy']);
        Route::get('views/{id}', [CandidateController::class, 'views']);
        Route::get('detail/{id}', [CandidateController::class, 'detail']);

        Route::get('interviewcreate/{id}/{jobid}', [CandidateController::class, 'interviewcreate']);

        // post
        Route::post('save', [CandidateController::class, 'store']);
        Route::post('update', [CandidateController::class, 'update']);

        Route::post('interviewsave', [CandidateController::class, 'interviewstore']);

        Route::get('scores/{id}', [CandidateController::class, 'scores']);
        Route::get('print/{id}', [CandidateController::class, 'print']);
    });

    Route::prefix('estimate')->namespace('Estimate')->group(function () {
        Route::get('/{id}/{jobid}/{workid}', [EstimateController::class, 'index']);
        Route::get('add/{id}/{userid}/{jobid}/{workid}', [EstimateController::class, 'create']);
        Route::get('edit/{id}', [EstimateController::class, 'edit']);
        Route::get('delete/{id}', [EstimateController::class, 'destroy']);
        Route::get('views/{id}', [EstimateController::class, 'report']);

        // post
        Route::post('save', [EstimateController::class, 'store']);
        Route::post('update', [EstimateController::class, 'update']);

        Route::get('views/{id}/{jobid}/{workid}', [EstimateController::class, 'views']);

        Route::get('print/{id}/{jobid}/{workid}', [EstimateController::class, 'print']);
    });

    // Route::get('candidate', [PersonalController::class, 'indexCandidate']);

    Route::get('employees/estimate/{id}/{typeid}', [EstimateEmployeesController::class, 'index']);

    Route::get('employees/estimate/years/{id}/{typeid}', [EstimateEmployeesController::class, 'years']);

    Route::post('employees/estimate/save', [EstimateEmployeesController::class, 'store']);


    Route::get('employees/behavior/{id}', [BehaviorEmployeesController::class, 'index']);
    
    Route::get('employees/behavior/{id}/add', [BehaviorEmployeesController::class, 'create']);

    Route::post('employees/behavior/{id}/save', [BehaviorEmployeesController::class, 'store']);

    Route::get('employees/behavior/detail/{id}', [BehaviorEmployeesController::class, 'detail']);

    // diagram Form
    Route::get('benefits/{id}', [BenefitsController::class, 'index']);

    Route::get('benefits/sub/{id}', [BenefitsController::class, 'indexSub']);

    Route::get('benefits/get/info', [BenefitsController::class, 'info']);

    Route::post('benefits/save', [BenefitsController::class, 'store']);

    Route::get('benefits/deleted/{id}', [BenefitsController::class, 'destroy']);

    Route::get('benefits/deletedfund/{id}', [BenefitsController::class, 'destroyfund']);

    Route::get('changepass', [ChangepassController::class, 'index']);    
    Route::post('changepass/save', [ChangepassController::class, 'store']);   
    

});