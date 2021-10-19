<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CarRegisterRequest;
use App\Models\Car;
use App\Helpers\ImageUpload;
use Illuminate\Support\Facades\Session;

class CarRegisterController extends Controller
{
    use imageUpload;
    public function __construct(Car $car) {
        $this->car = $car;
    }
    // Car registration by owner
    public function getRegister() {
        return view('cars.car-register');
    }

    public function postRegister(CarRegisterRequest $request) {
        try{
            if (request()->hasFile('photo')) {   
                $image = $this->commonImageUpload($request->photo, 'owner-register-car');
            }
            $ownerId = Session::get('id');
             $data = $request->except(['photo']);
             $data1=array_merge($data, ['photo'=>$image, 'owner_id'=>$ownerId]);
             $store = $this->car->create($data1);
            return redirect('/bmc');
            }
         catch(Exception $exception)
            {
             Log::error('Car registration error'.$exception->getMessage());
             return back()->with('error',$exception->getMessage());
            }
    }
}
