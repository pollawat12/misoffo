<?php 

use App\Http\Controllers\Office\Purchases\PurchaseController;


Route::prefix('purchase')->namespace('Purchase')->group(function () {

    Route::get('lists', [PurchaseController::class, 'index']);
    Route::get('add', [PurchaseController::class, 'create']);
    Route::get('edit/{id}', [PurchaseController::class, 'edit']);
    Route::get('detail/{id}', [PurchaseController::class, 'detail']);
    Route::get('delete/{id}', [PurchaseController::class, 'destroy']);
    Route::post('save', [PurchaseController::class, 'store']);
    Route::post('update', [PurchaseController::class, 'update']);
    Route::get('get/info', [PurchaseController::class, 'purchasesinfo']);

    Route::get('show/{id}', [PurchaseController::class, 'show']);
    Route::post('sub/save', [PurchaseController::class, 'substore']);
    Route::post('status/save', [PurchaseController::class, 'statusstore']);
    Route::get('sub/deleted/{id}', [PurchaseController::class, 'subdestroy']);

    Route::get('loadPurchase/{id}', [PurchaseController::class, 'loadPurchase']);

    Route::get('report', [PurchaseController::class, 'report']);
});