<?php

namespace App\Http\Controllers\Admin;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }

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

    function UserRegistration(Request $request){
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
