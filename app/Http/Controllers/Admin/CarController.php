<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    function createCar(Request $request){
        if($this->isAdmin($request)==true){
            // Prepare Car Image File Name & Path
            $img=$request->file('carImg');

            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="car-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";


            // Upload Car Image File
            $img->move(public_path('uploads'),$img_name);

            if($request->input('carAvailability')=="1"){
                $carAvailability = true;
            }else{
                $carAvailability = false;
            }
            
            // Save To Database
            return Car::create([
                'name'=>$request->input('carName'),
                'brand'=>$request->input('carBrand'),
                'model'=>$request->input('carModel'),
                'year'=>$request->input('carYear'),
                'car_type'=>$request->input('carType'),
                'daily_rent_price'=>$request->input('carRentPrice'),
                'availability'=>$carAvailability,
                'image'=>$img_url,
            ]);
        }else{
            return view('page.auth.login-page');
        }
    }

    function deleteCar(Request $request){
        if($this->isAdmin($request)==true){
            $carID=$request->input('id');
            $filePath=$request->input('file_path');
            File::delete($filePath);
            return Car::where('id',$carID)->delete();
        }else{
            return view('page.auth.login-page');
        }
    }

    function carByID(Request $request){
        if($this->isAdmin($request)==true){
            $carID=$request->input('id');
            return Car::where('id',$carID)->first();
        }else{
            return view('page.auth.login-page');
        }
    }
    function updateCar(Request $request){
        if($this->isAdmin($request)==true){
            $carID=$request->input('id');

            if($request->input('carAvailability')=="1"){
                $carAvailability = true;
            }else{
                $carAvailability = false;
            }

            if ($request->hasFile('carImage')) {

                // Upload New Car Photo File
                $img=$request->file('carImage');
                $t=time();
                $file_name=$img->getClientOriginalName();
                $img_name="car-{$t}-{$file_name}";
                $img_url="uploads/{$img_name}";

                // Upload Car Photo File
                $img->move(public_path('uploads'),$img_name);

                // Delete Old Car Photo File
                $filePath=$request->input('imagePath');
                File::delete($filePath);

                // Update Car
                return Car::where('id',$carID)->update([
                    'name'=>$request->input('carName'),
                    'brand'=>$request->input('carBrand'),
                    'model'=>$request->input('carModel'),
                    'year'=>$request->input('carYear'),
                    'car_type'=>$request->input('carType'),
                    'daily_rent_price'=>$request->input('carRentPrice'),
                    'availability'=>$carAvailability,
                    'image'=>$img_url,
                ]);

            }
            else {
                return Car::where('id',$carID)->update([
                    'name'=>$request->input('carName'),
                    'brand'=>$request->input('carBrand'),
                    'model'=>$request->input('carModel'),
                    'year'=>$request->input('carYear'),
                    'car_type'=>$request->input('carType'),
                    'daily_rent_price'=>$request->input('carRentPrice'),
                    'availability'=>$carAvailability,
                ]);
            }
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
