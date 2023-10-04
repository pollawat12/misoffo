<?php 

use App\Http\Controllers\Office\Strategy\SubjectController;

Route::prefix('manage-strategy')->namespace('Strategy')->group(function () {
    // subject
    Route::get('subject', [SubjectController::class, 'index']);
    Route::get('subject/add', [SubjectController::class, 'add']);
    Route::post('subject/save', [SubjectController::class, 'save']);                                     
});