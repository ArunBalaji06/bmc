<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct(Car $car) {
        $this->car = $car;
    }
 
    public function index() {
        $ownerId = Session::get('id');
        $cars = $this->car->where('owner_id',$ownerId)->pluck('photo');
        $details = $this->car->where('owner_id',$ownerId)->with('owner')->get();
        return view('dashboard',compact('cars'));
    }
}
