<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\rental;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    function customerView(Request $request){
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
        //return User::select('rentals.*')->join('rentals', 'rentals.user_id', '=', 'users.id')->where('users.role','customer')->where('rentals.status','completed')->get();
        //return Rental::select('users.*')->join('users', 'users.id', '=', 'rentals.user_id')->where('users.role','customer')->where('rentals.status','completed')->get();
        return User::where('role','customer')->get();
        
    }
}
