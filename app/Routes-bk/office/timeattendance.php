<?php

use App\Http\Controllers\Office\Timeattendance\WorktimeController;

Route::prefix('time-attendance')->namespace('Timeattendance')->group(function () {
    // time attendance
    Route::get('worktime', [WorktimeController::class, 'index']);
    Route::post('check-in-time', [WorktimeController::class, 'save']);
});