<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\Car;
use App\Models\Owner;
use App\Models\Client;
use Session;
use App\Mail\RequestMail;
use App\Mail\AcceptRequestMail;
use App\Mail\RejectRequestMail;
use App\Http\Requests\RejectBookingRequest;


class BookingController extends Controller
{
    public function __construct(Requests $request,Car $car, Owner $owner, Client $client) {
        $this->req = $req;
        $this->car = $car;
        $this->owner = $Owner;
        $this->client = $client;
    }

    //  Request given by client
    public function requestGiven($id) {
        try {
            $clientId = Session::get('id');
            $getClient = $this->client->where('id',$clientId)->first();
            $getCar = $this->car->where('id',$id)->with('owner')->first();
            $requestGiven = $this->req->create([
                'owner_id' => $getCar->owner->id,
                'client_id' => $clientId,
                'car_id' => $getCar->id,
                'status' => 0
            ]);

            $details = [
                'title' => 'Dear '.$getCar->owner->name.' your car has been requested for rental by '.$getClient->name,
                'description' => 'Please login to your dashboard to accept or reject the rental'
            ];

            Mail::to($getcar->owner->email)->send(new RequestMail($details));

            return back()->with('success','Request sent successfully, Please wait for the owner accept invitation');
        } catch(Exception $exception) {
            Log::error('Request sent failed'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Request accept by owner
    public function acceptRequest($id) {
        try{
            $ownerId = Session::get('id');
            $ownerName = $this->owner->where('id',$ownerId)->first();
            $getcarfromId = $this->req->where('id',$id)->first();
            $getCarOwner = $this->car->where('id',$getcarfromId->car_id)->with('owner')->first();
            $requestAccept = $this->req->where('id',$id)->update([
                'status' => 1
            ]);

            $clientName = $this->client->where('id',$requestAccept->client_id)->first();
            $details = [
                'title' => 'Dear '.$clientName->name.' your request has been accepted by '.$ownerName->name,
                'description' => 'Please login to your dashboard to start the payment process'
            ];

            Mail::to($getCarOwner->owner->email)->send(new AcceptRequestMail($details));
        } catch(Exception $exception) {
            Log::error('Acceptation sent failed'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }

    }

     // Request reject by owner
     public function rejectRequest(RejectBookingRequest $request) {
        try{
            $ownerId = Session::get('id');
            $ownerName = $this->owner->where('id',$ownerId)->first();
            $requestReject = $this->req->where('id',$request->id)->update([
                'status' => 2
            ]);

            $clientName = $this->client->where('id',$requestReject->client_id)->first();
            $details = [
                'title' => 'Dear '.$clientName->name.' your request has been rejected by '.$ownerName->name,
                'description' => 'Owner was unable to fulfill your request due to '.$request->description
            ];

            Mail::to($clientName->email)->send(new RejectRequestMail($details));
        } catch(Exception $exception) {
            Log::error('Rejection sent failed'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }

    }
}
