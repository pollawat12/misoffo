<?php 
use App\Http\Controllers\Office\Evaluation\Settings\IndicatorcategoryController;
use App\Http\Controllers\Office\Evaluatio\IndicatorController;

//office/evaluations/settings/indicator-category
Route::prefix('evaluations')->namespace('Evaluation')->group(function () {
    // setting
    Route::prefix('settings')->namespace('Settings')->group(function () {
        Route::prefix('indicator-category')->group(function () {
            Route::get('/', [IndicatorcategoryController::class, 'index']);
            Route::get('add', [IndicatorcategoryController::class, 'add']);
            Route::get('edit', [IndicatorcategoryController::class, 'edit']);
            Route::get('delete', [IndicatorcategoryController::class, 'delete']);
            Route::post('save', [IndicatorcategoryController::class, 'save']);
            Route::post('update', [IndicatorcategoryController::class, 'update']);

            Route::get('sub-cate', [IndicatorcategoryController::class, 'index_sub']);
            Route::get('sub-cate/add', [IndicatorcategoryController::class, 'add_sub']);
            Route::get('sub-cate/edit', [IndicatorcategoryController::class, 'edit_sub']);
            Route::get('sub-cate/delete', [IndicatorcategoryController::class, 'delete_sub']);
            Route::post('sub-cate/save', [IndicatorcategoryController::class, 'save_sub']);
            Route::post('sub-cate/update', [IndicatorcategoryController::class, 'update_sub']);
        });
    });
    //office/incomes/lists
    //                                                  evaluations/settings/indicator

    Route::prefix('indicator')->group(function () {
        Route::get('/', [IndicatorController::class, 'index']);
        Route::get('add', [IndicatorController::class, 'add']);
        Route::get('edit/{id}', [IndicatorController::class, 'edit']);
        Route::get('delete', [IndicatorController::class, 'delete']);
        Route::get('save', [IndicatorController::class, 'save']);
        Route::get('update', [IndicatorController::class, 'update']);
    });
});