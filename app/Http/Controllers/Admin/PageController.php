<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\rental;
use App\Models\user;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    function dashboardView(Request $request){
        $userID = $request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
                return view('page.dashboard.index');
        }else{
            return view('page.auth.login-page');
        }
    }
    function dashboardData(){
        try {
            $totalCars = Car::all()->count();
            $availableCars = Car::where('availability',true)->count();
            $totalRentals = Rental::where('status','completed')->count();
            $totalEarnings = Rental::where('status','completed')->sum('total_cost');
            return response()->json([
                'totalCars' => $totalCars,
                'availableCars' => $availableCars,
                'totalRentals' => $totalRentals,
                'totalEarnings' => $totalEarnings
            ],200);
        }catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unsuccessful'
            ],200);
        }
    }
    function manageCustomers(Request $request){
        $userID = $request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            return view('page.dashboard.customers');
        }else{
            return view('page.auth.login-page');
        }
    }
    function customerData(){
        return User::where('role','customer')->orderBy('updated_at', 'desc')->get();; 
    }

    function manageCars(Request $request){
        $userID = $request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            return view('page.dashboard.cars');
        }else{
            return view('page.auth.login-page');
        }
    }

    function carData(){
        try {
            return Car::query()
            ->orderBy('updated_at', 'desc')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unsuccessful'
            ],200);
        }
        
    }
}
