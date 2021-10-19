<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct(Owner $owner) {
        $this->owner = $owner;
    }
    // Owner register
    public function getRegister() {
        return view('auth.owner-register');
    }

    public function postRegister(OwnerRegisterRequest $request) {
        $ownerDetail = $request->validated();
        // dd($request->all());
        $password = $request->password;
        $confirmPassword = $request->confirm_password;
        if($password == $confirmPassword) {
            $validate = $this->owner->create($ownerDetail);
            $sessionId = $this->owner->where('email',$request->email)->first();
            $request->session()->put('id',$sessionId->id);
            return redirect('/bmc');
        } else {
            return back();
        }
        return redirect('/login');
    }

    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request) {
        $loginDetail = $request->validated();
        
        $email = $this->owner->where('email',$request->email)->first();
        if($email) {
            $password = $this->owner->where('password',$request->password)->first();
            $request->session()->put('id',$email->id);
            return redirect('bmc');
        } else {
            return back();
        }
        
    }

    
}
