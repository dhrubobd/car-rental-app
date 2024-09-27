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
        if($this->isAdmin($request)==true){
            return User::where('role','customer')->orderBy('updated_at', 'desc')->get();
        }else{
            return view('page.auth.login-page');
        }
    }

    function listAvailableCar(Request $request){
        if($this->isAdmin($request)==true){
            return Car::where('availability',true)
            ->orderBy('updated_at', 'desc')->get();
        }else{
            return view('page.auth.login-page');
        }
    }

    function createRental(Request $request){
        if($this->isAdmin($request)==true){
            $userID=$request->input('customerID');
            $carID=$request->input('carID');
            $startDate = $request->input('fromDate');
            $endDate = $request->input('toDate');
            $bookingDays = $request->input('bookingDays');
            $count1 = Rental::where('car_id',$carID)
            ->where('status','<>','cancelled')
            ->whereBetween('start_date',[$startDate, $endDate])->count();
            
            $count2 = Rental::where('car_id',$carID)
            ->where('status','<>','cancelled')
            ->whereBetween('end_date',[$startDate, $endDate])
            ->count();
            if(($count1==0)&&($count2==0)){
                $theCar = Car::where('id',$carID)->first();
            
                $dailyRent = $theCar->daily_rent_price;
                
                $totalCost = $bookingDays * $dailyRent;
               
            return Rental::create([
                    'user_id'=>$userID,
                    'car_id'=>$carID,
                    'start_date'=>$startDate,
                    'end_date'=>$endDate,
                    'status'=>'completed',
                    'total_cost'=>$totalCost,
                ]);
            }else{
                return  response()->json(['msg' => "The Car Can Not be Booked for the date range", 'data' =>  "Failed"],200);
            }
        }else{
            return view('page.auth.login-page');
        }
    }

    function rentalByID(Request $request){
        if($this->isAdmin($request)==true){
            $rentalID=$request->input('id');
            return Rental::where('id',$rentalID)->first();
        }else{
            return view('page.auth.login-page');
        }
    }
    function deleteRental(Request $request){
        if($this->isAdmin($request)==true){
            $rentalID=$request->input('id');
            return Rental::where('id',$rentalID)->delete();
        }else{
            return view('page.auth.login-page');
        }
        
    }
    
    function updateRental(Request $request){
        if($this->isAdmin($request)==true){
            $rentalID = $request->input('rentalID');
            $rentalStatus = $request->input('rentalStatus');
            return Rental::where('id',$rentalID)->update([
                'status'=>$rentalStatus,
            ]);
        }else{
            return view('page.auth.login-page');
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