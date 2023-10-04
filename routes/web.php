<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgetpwController;
use App\Http\Controllers\Auth\ChangepassController;
use App\Http\Controllers\Appform\EmployeeController;

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

//gggg



Route::get('/', function () {
    // return view('welcome');
    return redirect('dashboard');
});
// Route::get('/', [HomeController::class, 'index']);
// Route::prefix('/')->namespace('Dashboard')->group(function () {
//     Route::get('/', [HomeController::class, 'index']);
// });

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('forget-pw', [ForgetpwController::class, 'index'])->middleware('AlreadyLoggedIn');
    Route::post('forget-pw/save', [ForgetpwController::class, 'save'])->middleware('AlreadyLoggedIn');
    Route::get('login', [LoginController::class, 'index'])->middleware('AlreadyLoggedIn');
    Route::get('logout', [LogoutController::class, 'index']);
    Route::post('verify_login', [LoginController::class, 'verifyLogin'])->middleware('AlreadyLoggedIn');
});

Route::prefix('appform')->namespace('Appform')->group(function () {
    Route::get('projects', [EmployeeController::class, 'projects']);
    Route::get('jobs/{id}', [EmployeeController::class, 'jobs']);
    Route::get('apply/{id}', [EmployeeController::class, 'create']);
    Route::get('add/{id}', [EmployeeController::class, 'index']);
    Route::post('save', [EmployeeController::class, 'store']);
    Route::post('sub/save', [EmployeeController::class, 'substore']);
});


Route::prefix('')->middleware('isLogged')->group(function () {
    include_once(app_path('Routes/dashboard.php'));

     // office
    Route::prefix('office')->namespace('Office')->group(function () {

        // budgets
        include_once(app_path('Routes/office/budgets.php'));

        // expenses
        include_once(app_path('Routes/office/expenses.php'));
        

        // budget
        include_once(app_path('Routes/office/budget.php'));

        // hr
        include_once(app_path('Routes/office/hr.php'));

        // durable
        include_once(app_path('Routes/office/durable.php'));

        // purchases
        include_once(app_path('Routes/office/purchases.php'));

        // purchase
        include_once(app_path('Routes/office/purchase.php'));

        // incomes
        include_once(app_path('Routes/office/incomes.php'));

        // budget
        include_once(app_path('Routes/office/budget.php'));
        
        // service
        include_once(app_path('Routes/office/service.php'));

        // setting
        include_once(app_path().'/Routes/office/setting.php');
        
        include_once(app_path().'/Routes/office/my.php');

        include_once(app_path().'/Routes/office/evaluation.php');

        // include_once(app_path().'/Routes/office/strategy.php');

        include_once(app_path().'/Routes/office/management.php');

        include_once(app_path().'/Routes/office/strategic.php');

        // -- add by M 4/06/2022 -- //
        include_once(app_path().'/Routes/office/timeattendance.php');
    });
});



//->middleware('isLogged');

// Route::prefix('office')->group(function () {
//     Route::prefix('dashboard')->group(function () {
//         Route::get('/', [DashboardController::class, 'index']);
//         // Route::get('hr', []);
//     });
// });

// Route::prefix('office')->middleware('auth')->group(function () {



// });//['middleware' => ['auth']
