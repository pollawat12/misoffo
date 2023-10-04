<?php 

use App\Http\Controllers\Office\Purchases\PurchasesController;


Route::prefix('purchases')->namespace('Purchases')->group(function () {

    Route::get('lists', [PurchasesController::class, 'index']);
    Route::get('add', [PurchasesController::class, 'create']);
    Route::get('edit/{id}', [PurchasesController::class, 'edit']);
    Route::get('detail/{id}', [PurchasesController::class, 'detail']);
    Route::get('delete/{id}', [PurchasesController::class, 'destroy']);
    Route::post('save', [PurchasesController::class, 'store']);
    Route::post('update', [PurchasesController::class, 'update']);
    Route::get('get/info', [PurchasesController::class, 'purchasesinfo']);

    Route::get('show/{id}', [PurchasesController::class, 'show']);
    Route::post('sub/save', [PurchasesController::class, 'substore']);
    Route::post('status/save', [PurchasesController::class, 'statusstore']);
    Route::get('sub/deleted/{id}', [PurchasesController::class, 'subdestroy']);

    Route::get('loadPurchase/{id}', [PurchasesController::class, 'loadPurchase']);

    Route::get('report', [PurchasesController::class, 'report']);
});