<?php

namespace App\Http\Controllers\Admin;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\rental;
use App\Models\user;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    function createCustomer(Request $request){
        if($this->isAdmin($request)==true){
            //return $request->all();
            
            $customerName=$request->input('customerName');
            $customerEmail = $request->input('customerEmail');
            $customerPhone = $request->input('customerPhone');
            $customerAddress = $request->input('customerAddress');
            $customerPassword = $request->input('customerPassword');

            try {
                return User::create([
                    'name'=>$customerName,
                    'email'=>$customerEmail,
                    'phone'=>$customerPhone,
                    'address'=>$customerAddress,
                    'password'=>$customerPassword,
                    'role'=>'customer'
                ]);
                } catch (\Throwable $th) {
                    return  response()->json(['msg' => "Customer is not created", 'data' =>  "Failed"],200);
                }
        }else{
            return view('page.auth.login-page');
        }
    }

    function deleteCustomer(Request $request){
        if($this->isAdmin($request)==true){
            $customerID = $request->input('id');
            try {
                return User::where('id',$customerID)->delete();
            } catch (\Throwable $th) {
                return  response()->json(['msg' => "Customer is not Deleted", 'data' =>  "Failed"],200);
            }
        }else{
            return view('page.auth.login-page');
        }
    }

    function customerByID(Request $request){
        if($this->isAdmin($request)==true){
            $customerID=$request->input('id');
            return User::where('id',$customerID)->first();
        }else{
            return view('page.auth.login-page');
        }
        
    }
    function updateCustomer(Request $request){
        if($this->isAdmin($request)==true){
            $customerID=$request->input('id');
            $customerName = $request->input('name');
            $customerEmail = $request->input('email');
            $customerPhone = $request->input('phone');
            $customerAddress = $request->input('address');
            $customerPassword = $request->input('password');
            return User::where('id',$customerID)
                ->update([
                    'name'=>$customerName,
                    'email'=>$customerEmail,
                    'phone'=>$customerPhone,
                    'address'=>$customerAddress,
                    'password'=>$customerPassword,
                ]);
        }else{
            return view('page.auth.login-page');
        }
    }
    function customerRentals(Request $request){
        if($this->isAdmin($request)==true){
            $customerID = $request->input('id');
            return Rental::where('user_id',$customerID)->get();
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
