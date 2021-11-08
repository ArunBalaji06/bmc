<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientDetail;
use App\Models\ClientProof;
use App\Http\Requests\ClientRegistrationRequest;
use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ClientProofRequest;
use Illuminate\Support\Facades\Session;
use App\Helpers\ImageUpload;
use App\Helpers\UuidModel;

class CilentAuthController extends Controller
{
    use imageUpload,UuidModel;
    public function __construct(Client $client,ClientDetail $clientDetail,ClientProof $clientProof) {
        $this->client = $client;
        $this->clientDetail = $clientDetail;
        $this->clientProof = $clientProof;
    }

    // Client registration-page->get
    public function getRegister() {
        return view('client.registration');
    }

    // Client register->post
    public function postRegister(ClientRegistrationRequest $request) {
        $clientDetails = $request->validated();
        $password = $request->password;
        $confirmPassword = $request->confirm_password;
        if($request->hasFile('photo')) {
            $image = $this->commonImageUpload($request->photo, 'client-image');
        }
        if($request->hasFile('client_proof_front')) {
            $image1 = $this->commonImageUpload($request->client_proof_front, 'client-proof-front');
        }
        if($request->hasFile('client_proof_back')) {
            $image2 = $this->commonImageUpload($request->client_proof_back, 'client-proof-back');
        }
        if($password == $confirmPassword) {
            $validate = $this->client->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $confirmPassword
            ]);
            $sessionId = $this->client->where('email',$request->email)->first();
            $request->session()->put('id',$sessionId->id);
            $detail = $this->clientDetail->create([
                'client_id' => $sessionId->id,
                'client_image' => $image,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]);
            $proof = $this->clientProof->create([
                'client_detail_id' => $detail->id,
                'client_proof_front' => $image1,
                'client_proof_back' => $image2
            ]);
            return view('client.dashboard');
        } else {
            return back();
        }
    }

    // Client login-page->get
    public function getLogin() {
        return view('client.login-page');
    }

    // Client post login->post
    public function postLogin(ClientLoginRequest $request) {
        $loginDetail = $request->validated();
        $email = $this->client->where('email',$request->email)->first();
        if($email) {
            $password = $this->owner->where('password',$request->password)->first();
            $request->session()->put('id',$email->id);
            return redirect('client.dashboard');
        } else {
            return redirect('/register');
        }
    }

    // Client logout->get
    public function logout() {
        Session::flush();
        return redirect('/client-login');
    }

    // View client profile->get
    public function viewProfile() {
        $clientId = Session::get('id');
        $clientProfile = $this->client->where('id',$clientId)->with('clientDetail','clientDetail.clientProof')->first();
        // dd($clientProfile);
        return view('client.client-profile',compact('clientProfile'));
    }

    // Edit client profile-update->post
    public function editProfile(ClientProofRequest $request) {
        try{
            // dd($request);
            $clientId = Session::get('id');
            // dd($clientId);
            $clientDetailId = $this->clientDetail->where('client_id',$clientId)->first();
            $clientProofs = $this->clientProof->where('client_detail_id',$clientDetailId->id)->first();
            // dd($ownerProofs);
            $img['client_image'] = $clientDetailId->client_image;
            $img['client_proof_front'] = $clientProofs->client_proof_front;
            $img['client_proof_back'] = $clientProofs->client_proof_back;
            
            if (request()->hasFile('client_image') || request()->hasFile('client_proof_front') || request()->hasFile('client_proof_back')) {
                $this->clientImageUpdate($img,$request);
                $image  = $request->has('client_image') ? $this->commonImageUpload($request->client_image, 'client-image') : $img['client_image'];
                $image1 = $request->has('client_proof_front') ? $this->commonImageUpload($request->client_proof_front, 'client-proof-front') : $img['client_proof_front'];
                $image2 = $request->has('client_proof_back') ? $this->commonImageUpload($request->client_proof_back, 'client-proof-back') : $img['client_proof_back'];
            } else {
                $image = $img['client_image'];
                $image1 = $img['client_proof_front'];
                $image2 = $img['client_proof_back'];
            }

            $mainDetail = $this->client->where('id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            $findOwner = $this->clientDetail->where('client_id',$clientId)->update([
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
                'client_image'  => $image
            ]);
            // dd($owenrDetailId->id);
            $findProof = $this->clientProof->where('client_detail_id',$clientDetailId->id)->update([
                'client_proof_front' => $image1,
                'client_proof_back'  => $image2
            ]);
            return back()->with('success','client profile updated successfully');
            
        } catch(Exception $exception) {
            Log::error('Profile update error'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Deleting owner->get
    public function deleteClient($id) {
        Session::flush();
        $deletClient = $this->client->where('id',$id)->delete();
    }
}
