<?php 

use App\Http\Controllers\Office\Strategic\OilController;
use App\Http\Controllers\Office\Strategic\ImportController;
use App\Http\Controllers\Office\Strategic\SettingsController;

Route::prefix('strategic')->namespace('Strategic')->group(function () {

    Route::prefix('oil')->group(function () {
        Route::get('lists', [OilController::class, 'index']);
        Route::get('add', [OilController::class, 'create']);
        Route::get('edit/{id}', [OilController::class, 'edit']);
        Route::get('delete/{id}', [OilController::class, 'destroy']);
        Route::get('report/{id}', [OilController::class, 'report']);

        Route::post('save', [OilController::class, 'store']);
        Route::post('update', [OilController::class, 'update']);

        Route::get('import/lists', [ImportController::class, 'importform']);

        Route::post('import/save', [ImportController::class, 'importsave']);

        Route::get('settings/lists', [SettingsController::class, 'index']);
        Route::get('settings/add', [SettingsController::class, 'create']);
        Route::get('settings/edit/{id}', [SettingsController::class, 'edit']);
        Route::get('settings/delete/{id}', [SettingsController::class, 'destroy']);

        Route::post('settings/save', [SettingsController::class, 'store']);
        Route::post('settings/update', [SettingsController::class, 'update']);
    });    
});