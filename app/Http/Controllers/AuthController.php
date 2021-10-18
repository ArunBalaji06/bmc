<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Requests\LoginRequest;

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
        if($request->password == $request->confirm_password) {
            $validate = $this->owner->create($ownerDetail);
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
            return redirect('bmc');
        } else {
            return back();
        }
        
    }

    public function index() {
        return view('dashboard');
    }
}
