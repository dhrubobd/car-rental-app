<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CarRentalMail;
use App\Models\car;
use App\Models\rental;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    function bookCar(Request $request){
        //return $request->all();
        
      
        $userID=$request->header('id');
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
        
            try {
                $theCustomer = User::where('id',$userID)->first();
                $customerEmail = $theCustomer->email;
                $customerName = $theCustomer->name;
                $carName = $theCar->name;

                Mail::to($customerEmail)->send(new CarRentalMail($customerName, $carName, $startDate, $endDate,$totalCost));
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Email could not be sent.'
                ],200);
            }
           return Rental::create([
                'user_id'=>$userID,
                'car_id'=>$carID,
                'start_date'=>$startDate,
                'end_date'=>$endDate,
                'status'=>'ongoing',
                'total_cost'=>$totalCost,
            ]);
        }else{
            return  response()->json(['msg' => "The Car Can Not Be Booked for the date range", 'data' =>  "Failed"],200);
        }
    }

    function bookingList(Request $request){
        $userID=$request->header('id');
        
        return Rental::where('user_id',$userID)->get();
    }

    function cancelBooking(Request $request){
        $userID=$request->header('id');
        $bookingID=$request->input('bookingID');

        return Rental::where('id',$bookingID)->where('user_id',$userID)
            ->update([
                'status'=>'cancelled'
            ]);
    }
}
