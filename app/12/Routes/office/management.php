<?php 

use App\Http\Controllers\Office\Management\SubjectController;

Route::prefix('management')->namespace('Management')->group(function () {
    // subject
    // office/management/subject
    Route::get('subject', [SubjectController::class, 'index']);
    Route::get('subject/add', [SubjectController::class, 'add']);
    Route::get('subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('subject/save', [SubjectController::class, 'save']);
    Route::post('subject/update', [SubjectController::class, 'update']);

    // import

});
