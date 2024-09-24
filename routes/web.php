<?php

use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Middleware\Authenticate;
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
//User Routes
Route::post('/user-login',[AdminCustomerController::class,'userLogin']);
Route::get('/logout',[AdminCustomerController::class,'userLogout']);
Route::post('/user-registration',[AdminCustomerController::class,'userRegistration']);

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

Route::get('/manage-bookings', function () {
    return view('page.customer.manage-bookings');
})->middleware([TokenVerificationMiddleware::class]);

// Page Routes (Admin)
Route::get('/dashboard',[AdminPageController::class,'dashboardView'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard/dashboard-data',[AdminPageController::class,'dashboardData'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard/manage-customers',[AdminPageController::class,'customerView'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard/customer-data',[AdminPageController::class,'customerData'])->middleware([TokenVerificationMiddleware::class]);


// User  / Customer Routes (Admin)
Route::post('/dashboard/create-customer',[AdminCustomerController::class,'createCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/delete-customer',[AdminCustomerController::class,'deleteCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/update-customer',[AdminCustomerController::class,'updateCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/customer-by-id',[AdminCustomerController::class,'customerByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/customer-rentals',[AdminCustomerController::class,'customerRentals'])->middleware([TokenVerificationMiddleware::class]);


//Car Routes
Route::get('/list-cars',[CarController::class,'carList'])->middleware([TokenVerificationMiddleware::class]);

//Rental Routes
Route::post('/book-car',[RentalController::class,'bookCar'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/list-bookings',[RentalController::class,'bookingList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/cancel-booking',[RentalController::class,'cancelBooking'])->middleware([TokenVerificationMiddleware::class]);