<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\Settings\CarsController;
use App\Http\Controllers\Office\Settings\RolesController;
use App\Http\Controllers\Office\Settings\YearsController;
use App\Http\Controllers\Office\Settings\UsersroleController;

use App\Http\Controllers\Office\Settings\DatasettingController;
use App\Http\Controllers\Office\Settings\Meeting\RoomController;
use App\Http\Controllers\Office\Settings\Meeting\TypeController;
use App\Http\Controllers\Office\Settings\Meeting\AccessoryController;

Route::prefix('settings')->namespace('Settings')->group(function () {
    // -------------- Cars --------------------//
    Route::prefix('cars')->group(function () {
        Route::get('/', [CarsController::class, 'index']);
        Route::get('add', [CarsController::class, 'add']);
        Route::get('edit/{id}', [CarsController::class, 'edit']);
        Route::post('save', [CarsController::class, 'save']);
        Route::post('update', [CarsController::class, 'update']);
        Route::post('delete', [CarsController::class, 'delete']);
    });
    // ------------- Start Meeting --------------- //
    Route::prefix('meeting_room')->group(function () {
        Route::get('/', [RoomController::class, 'index']);
        Route::get('add', [RoomController::class, 'add']);
        Route::get('edit/{id}', [RoomController::class, 'edit']);
        Route::post('delete', [RoomController::class, 'delete']);
        Route::post('save', [RoomController::class, 'save']);
        Route::post('update', [RoomController::class, 'update']);
    });

    Route::prefix('meeting_type')->group(function () {
        Route::get('/', [TypeController::class, 'index']);
        Route::get('add', [TypeController::class, 'add']);
        Route::get('edit/{id}', [TypeController::class, 'edit']);
        Route::post('delete', [TypeController::class, 'delete']);
        Route::post('save', [TypeController::class, 'save']);
        Route::post('update', [TypeController::class, 'update']);
    });

    Route::prefix('meeting_item')->group(function () {
        Route::get('/', [AccessoryController::class, 'index']);
        Route::get('add', [AccessoryController::class, 'add']);
        Route::get('edit/{id}', [AccessoryController::class, 'edit']);
        Route::post('delete', [AccessoryController::class, 'delete']);
        Route::post('save', [AccessoryController::class, 'save']);
        Route::post('update', [AccessoryController::class, 'update']);
    });
    // ------------- End Meeting --------------- //

    // budget year
    Route::prefix('budget-year')->group(function () {

        Route::get('/', [YearsController::class, 'index']);
        Route::get('add', [YearsController::class, 'create']);
        Route::get('edit/{id}', [YearsController::class, 'edit']);
        Route::get('delete/{id}', [YearsController::class, 'destroy']);

        // post
        Route::post('save', [YearsController::class, 'store']);
        Route::post('update', [YearsController::class, 'update']);
    });

    // data 
    Route::prefix('data')->group(function () {
        Route::get('lists', [DatasettingController::class, 'index']);
        Route::get('add', [DatasettingController::class, 'create']);
        Route::get('edit/{id}', [DatasettingController::class, 'edit']);
        Route::get('delete/{id}', [DatasettingController::class, 'destroy']);

        // post
        Route::post('save', [DatasettingController::class, 'store']);
        Route::post('update', [DatasettingController::class, 'update']);
        
        Route::get('get/info', [DatasettingController::class, 'info']);
        Route::post('info/save', [DatasettingController::class, 'infosave']);
    });

    // line

    // roles
    Route::prefix('roles')->group(function () {
        Route::get('lists', [RolesController::class, 'index']);
        Route::get('edit/{id}', [RolesController::class, 'edit']);
        Route::post('update/permis/save', [RolesController::class, 'updatepermiss']);
    });

    // export
    Route::prefix('exports')->group(function () {
        Route::get('lists', [DatasettingController::class, 'exports']);
        Route::get('downloads', [DatasettingController::class, 'downloads']);
    });

    // user role
    Route::prefix('users')->group(function () {
        Route::get('lists', [UsersroleController::class, 'index']);
        Route::get('edit/{id}', [UsersroleController::class, 'edit']);

        // post
        Route::post('update', [UsersroleController::class, 'update']);
    });
});
