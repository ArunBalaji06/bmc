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


class CilentAuthController extends Controller
{
    public function __construct(Client $client,ClientDetail $clientDetail,ClientProof $clientProof) {
        $this->client = $client;
        $this->clientDetail = $clientDetail;
        $this->clientProof = $clientProof;
    }

    // Client registration-page->get
    public function getRegister() {
        return view('client.registration-page');
    }

    // Client register->post
    public function postRegister(ClientRegistrationRequest $request) {
        $clientDetails = $request->validated();
        $password = $request->password;
        $confirmPassword = $request->confirm_password;
        if($password == $confirmPassword) {
            $validate = $this->client->create($clientDetails);
            $sessionId = $this->client->where('email',$request->email)->first();
            $request->session()->put('id',$sessionId->id);
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
        return redirect('/client-logout');
    }

    // View client profile->get
    public function viewProfile() {
        $clientId = Session::get('id');
        $clientProfile = $this->client->where('id',$clientId)->with('clientDetail')->with('clientDetail.clientProof')->first();
        return view('client.client-profile');
    }

    // Edit client profile-update->post
    public function editProfile(ClientProofRequest $request) {
        $clientId = Session::get('id');
        
    }
}
