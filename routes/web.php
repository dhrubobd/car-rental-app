<?php

use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Auth;
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
//User Authentication Routes
Route::get('/login', function () {
    return view('page.auth.login-page');
});
Route::get('/registration', function () {
    return view('page.auth.registration-page');
});
Route::post('/user-login',[AuthController::class,'userLogin']);
Route::get('/logout',[AuthController::class,'userLogout']);
Route::post('/user-registration',[AuthController::class,'userRegistration']);

// Page Routes (Frontend - Static Pages)
Route::get('/', function () {
    return view('page.home');
});
Route::get('/about', function () {
    return view('page.about');
});
Route::get('/rentals', function () {
    return view('page.rentals');
});

Route::get('/contact', function () {
    return view('page.contact');
});

// Page Routes (Admin)
Route::get('/dashboard',[AdminPageController::class,'dashboardView'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard/manage-customers',[AdminPageController::class,'manageCustomers'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard/manage-cars',[AdminPageController::class,'manageCars'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard/manage-rentals',[AdminPageController::class,'manageRentals'])->middleware([TokenVerificationMiddleware::class]);

// API Routes Used for Pages (Admin)
Route::post('/dashboard/dashboard-data',[AdminPageController::class,'dashboardData'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/customer-data',[AdminPageController::class,'customerData'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/car-data',[AdminPageController::class,'carData'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/rental-data',[AdminPageController::class,'rentalData'])->middleware([TokenVerificationMiddleware::class]);


// User or Customer Management Routes (Admin)
Route::post('/dashboard/create-customer',[AdminCustomerController::class,'createCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/delete-customer',[AdminCustomerController::class,'deleteCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/update-customer',[AdminCustomerController::class,'updateCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/customer-by-id',[AdminCustomerController::class,'customerByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/customer-rentals',[AdminCustomerController::class,'customerRentals'])->middleware([TokenVerificationMiddleware::class]);

// Car Management Routes (Admin)
Route::post('/dashboard/create-car',[AdminCarController::class,'createCar'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/delete-car',[AdminCarController::class,'deleteCar'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/car-by-id',[AdminCarController::class,'carByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/update-car',[AdminCarController::class,'updateCar'])->middleware([TokenVerificationMiddleware::class]);

// Rental Management Routes (Admin)
Route::post('/dashboard/list-customer',[AdminRentalController::class,'listCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/list-available-car',[AdminRentalController::class,'listAvailableCar'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/create-rental',[AdminRentalController::class,'createRental'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/delete-rental',[AdminRentalController::class,'deleteRental'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/rental-by-id',[AdminRentalController::class,'rentalByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/dashboard/update-rental',[AdminRentalController::class,'updateRental'])->middleware([TokenVerificationMiddleware::class]);


// Page Routes (Customer)
Route::get('/customer-cars',[PageController::class,'customerCarsView'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/manage-bookings',[PageController::class,'manageBookingView'])->middleware([TokenVerificationMiddleware::class]);

//User or Customer Car Routes (Frontend)
Route::get('/list-cars',[CarController::class,'carList'])->middleware([TokenVerificationMiddleware::class]);

//User or Customer Rental Routes (Frontend)
Route::get('/list-bookings',[RentalController::class,'bookingList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/book-car',[RentalController::class,'bookCar'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/cancel-booking',[RentalController::class,'cancelBooking'])->middleware([TokenVerificationMiddleware::class]);