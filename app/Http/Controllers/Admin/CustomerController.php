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
    function userLogin(Request $request){
        $count=User::where('email','=',$request->input('email'))
             ->where('password','=',$request->input('password'))
             ->select(['id','role'])->first();
 
        if($count!==null){
            // User Login-> JWT Token Issue
            $token=JWTToken::CreateToken($request->input('email'),$count->id);
            $role = $count->role;
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
                'token'=>$token ,
                'role'=> $role
            ],200)->cookie('token',$token,time()+60*24*30);
        }
        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ],200);
 
        }
 
     }

     function userLogout(){
        return redirect('/')->cookie('token','',-1);
    }

    function userRegistration(Request $request){
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => $request->input('password'),
                'role' => "customer"
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully'
            ],200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ],200);

        }
    }

    function createCustomer(Request $request){
        //return $request->all();
        $userID=$request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
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
        $userID=$request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            $customerID = $request->input('id');
            try {
                return User::where('id',$customerID)->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }else{
            return view('page.auth.login-page');
        }
    }

    function customerByID(Request $request){
        $userID=$request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            $customerID=$request->input('id');
            return User::where('id',$customerID)->first();
        }else{
            return view('page.auth.login-page');
        }
        
    }
    function updateCustomer(Request $request){
        $userID=$request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
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
        $userID=$request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            $customerID = $request->input('id');
            return Rental::where('user_id',$customerID)->get();
        }else{
            return view('page.auth.login-page');
        }
    }
}
