<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CarRegisterRequest;
use App\Models\Car;
use App\Models\Requests;
use App\Models\Rental;
use App\Models\Payment;
use App\Models\Complain;
use App\Models\Damage;
use App\Helpers\ImageUpload;
use Illuminate\Support\Facades\Session;

class CarRegisterController extends Controller
{
    use imageUpload;
    public function __construct(Car $car) {
        $this->car = $car;
    }

    // Car registration page->get
    public function getRegister() {
        return view('cars.car-register');
    }

    // Car register->post
    public function postRegister(CarRegisterRequest $request) {
        try {
            if (request()->hasFile('photo')) {   
                $image = $this->commonImageUpload($request->photo, 'owner-register-car');
            }
            $ownerId = Session::get('id');
            $data = $request->except(['photo']);
            $data1=array_merge($data, ['photo'=>$image, 'owner_id'=>$ownerId]);
            $store = $this->car->create($data1);
            return redirect('/bmc');
            }
        catch(Exception $exception) {
            Log::error('Car registration error'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Single car full details view->get
    public function viewCarDetails($id) {
        $ownerId = Session::get('id');
        $viewCar = $this->car->where('id',$id)
                             ->with('request')
                             ->with('request.client')
                             ->with('request.payment')
                             ->first();
                            //  dd($viewCar);
        // $carRental = $this->rental->where('payment_id',$viewCar->request->payment->id)
        //                           ->with('damage')
        //                           ->with('complain')
        //                           ->get();
        return view('cars.view-car',compact('viewCar'));
    }

    // Single car edit-page->get
    public function editCar($id) {
        $ownerId = Session::get('id');
        $editCar = $this->car->where('id',$id)->where('owner_id',$ownerId)->first();
        return view('cars.view-car',compact('editCar'));
    }

    // Update a car->post
    public function updateCar(Request $request) {
        try {
            $ownerId = Session::get('id');
            if (request()->hasFile('car_image')) { 
                $imgsCar = $this->car->where('id',$request->id)->first();
                $img['car_image'] = $imgsCar->photo;
                $this->updatingImage($img,$request);
                $image = $this->commonImageUpload($request->car_image, 'owner-register-car');
            } else {
                $imgCar = $this->car->where('id',$request->id)->first();
                // dd($imgCar);
                $image = $imgCar->photo;
            }
            $findCar = $this->car->where('id',$request->id)->update([
                'owner_id'          => $ownerId,
                'model'             => $request->model,
                'seating_capacity'  => $request->seating_capacity,
                'price'             => $request->price,
                'availability'      => $request->availability,
                'photo'             => $image
            ]);
            return back()->with('success','Car updated successfully');
        } catch(Exception $exception) {
            Log::error('Car update error'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Delete car->get
    public function deleteCar($id) {
        try {
            $ownerId = Session::get('id');
            $deleteCar = $this->car->where('id',$id)->where('owner_id',$ownerId)->delete();
            return back()->with('success','Car deleted successfully!');
        } catch(Exception $exception) {
            Log::error('Car delete failed'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }
}
