<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Page Routes (Customer)
Route::get('/', function () {
    return view('page.home');
});
Route::get('/login', function () {
    return view('page.auth.login-page');
});
Route::get('/registration', function () {
    return view('page.auth.registration-page');
});

Route::get('/cars', function () {
    return view('page.customer.cars');
})->middleware([TokenVerificationMiddleware::class]);

// Page Routes (Admin)
Route::get('/dashboard',function () {
    return view('page.dashboard.index');
})->middleware([TokenVerificationMiddleware::class]);

//User Routes
Route::post('/user-login',[CustomerController::class,'userLogin']);
Route::get('/logout',[CustomerController::class,'userLogout']);
Route::post('/user-registration',[CustomerController::class,'userRegistration']);
//Route::resource('/customer', CustomerController::class);

//Car Routes
Route::get('/list-cars',[CarController::class,'carList']);
