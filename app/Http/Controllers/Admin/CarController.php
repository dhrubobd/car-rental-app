<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    function createCar(Request $request){
        // Prepare File Name & Path
        $img=$request->file('carImg');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="car-{$t}-{$file_name}";
        $img_url="uploads/{$img_name}";


        // Upload Image File
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
    }

    function deleteCar(Request $request){
        $carID=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Car::where('id',$carID)->delete();
    }

    function carByID(Request $request){
        $carID=$request->input('id');
        return Car::where('id',$carID)->first();
    }
    function updateCar(Request $request){
        $carID=$request->input('id');

        if($request->input('carAvailability')=="1"){
            $carAvailability = true;
        }else{
            $carAvailability = false;
        }

        if ($request->hasFile('carImage')) {

            // Upload New File
            $img=$request->file('carImage');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="car-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";

            // Upload Car Photo
            $img->move(public_path('uploads'),$img_name);

            // Delete Old File
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
    }
}
