<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\rental;
use App\Models\user;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    function listCustomer(Request $request){
        if($this->isAdmin($request)){
            return User::where('role','customer')->orderBy('updated_at', 'desc')->get();
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Unautorized User'
            ],200);
        }
    }

    function listAvailableCar(Request $request){
        if($this->isAdmin($request)){
            return Car::where('availability',true)
            ->orderBy('updated_at', 'desc')->get();
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Unautorized User'
            ],200);
        }
    }
    function deleteRental(Request $request){
        if($this->isAdmin($request)){
            $rentalID=$request->input('id');
            return Rental::where('id',$rentalID)->delete();
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Unautorized User'
            ],200);
        }
        
    }

    function isAdmin(Request $request){
        $userID = $request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            return true;
        }else{
            return false;
        }
    }
}