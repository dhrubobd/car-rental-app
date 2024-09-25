<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
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
}
