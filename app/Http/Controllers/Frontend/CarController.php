<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    function carList(){
        return Car::where('availability',true)->get();
        //return Car::all();
    }
}
