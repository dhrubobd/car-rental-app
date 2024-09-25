<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    
    function deleteRental(Request $request){
        $rentalID=$request->input('id');
        return Rental::where('id',$rentalID)->delete();
    }
}
