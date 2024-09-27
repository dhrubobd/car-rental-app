<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PageController extends Controller
{
    function customerCarsView(){
        return view('page.customer.cars');
    }
    function manageBookingView(){
        return view('page.customer.manage-bookings');
    }
}
