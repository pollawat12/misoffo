<?php 

use App\Http\Controllers\Office\Profile\ChangepassController;

Route::prefix('my')->namespace('Profile')->group(function () {
    // change password
    Route::get('changepass', 'ChangepassController@index');    
    Route::post('changepass/save', 'ChangepassController@store');    

    // inbox
    // Route::prefix('inbox')->group(function () {
    //     Route::get('/', 'InboxsController@index');    
    // });
});