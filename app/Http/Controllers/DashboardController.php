<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Models\Requests;
use App\Models\Payment;
use App\Models\Complain;
use App\Models\Damage;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct(Car $car, Rental $rental, Request $req, Payment $payment, Complain $complain, Damage $damage) {
        $this->car      = $car;
        $this->rental   = $rental;
        $this->req      = $req; 
        $this->payment  = $payment;
        $this->complain = $complain;
        $this->damage   = $damage;
    }
 
    // Owner dashboard->get
    public function index() {
        $ownerId = Session::get('id');
        $cars = $this->car->where('owner_id',$ownerId)->get();
        $requ = $this->req->where('owner_id',$ownerId)->with('payment')->with('payment.rental')->get();
        $transaction = $this->payment->where('request_id',$requ->id)->get();
        return view('dashboard',compact('cars','requ','transaction'));
    }

}
