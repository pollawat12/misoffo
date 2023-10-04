<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('login', [LoginController::class, 'index']);
    Route::post('verify_login', [LoginController::class, 'verifyLogin']);
})->middleware('AlreadyLoggedIn');




include_once(app_path('Routes/dashboard.php'))->middleware('isLogged');

// hr
include_once(app_path().'/Routes/office/hr.php');

// Route::prefix('office')->group(function () {
//     Route::prefix('dashboard')->group(function () {
//         Route::get('/', [DashboardController::class, 'index']);
//         // Route::get('hr', []);
//     });
// });

// Route::prefix('office')->middleware('auth')->group(function () {



// });//['middleware' => ['auth']