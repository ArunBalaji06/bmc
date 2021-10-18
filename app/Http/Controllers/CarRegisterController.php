<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarRegisterController extends Controller
{
    // Car registration by owner
    public function getRegister() {
        return view('cars.car-register');
    }
}
