<?php 

use App\Http\Controllers\Office\My\ChangepassController;

Route::prefix('my')->namespace('My')->group(function () {
    // change password
    Route::get('changepass', [ChangepassController::class, 'index']);    
    Route::post('changepass/save', [ChangepassController::class, 'store']);   

    // inbox
    // Route::prefix('inbox')->group(function () {
    //     Route::get('/', 'InboxsController@index');    
    // });
});