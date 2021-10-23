<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\OwnerDetail;
use App\Models\OwnerProof;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OwnerProfileRequest;
use App\Helpers\ImageUpload;

class AuthController extends Controller
{
    use imageUpload;
    public function __construct(Owner $owner,OwnerDetail $ownerDetail,OwnerProof $ownerProof) {
        $this->owner       = $owner;
        $this->ownerDetail = $ownerDetail;
        $this->ownerProof  = $ownerProof;

    }
    // Owner register-page->get
    public function getRegister() {
        return view('auth.owner-register');
    }

    // Owner register->post
    public function postRegister(OwnerRegisterRequest $request) {
        $ownerDetails = $request->validated();
        $password = $request->password;
        $confirmPassword = $request->confirm_password;
        if($password == $confirmPassword) {
            $validate = $this->owner->create($ownerDetails);
            $sessionId = $this->owner->where('email',$request->email)->first();
            $request->session()->put('id',$sessionId->id);
            return redirect('/bmc');
        } else {
            return back();
        }
    }

    // Owner login-page->get
    public function getLogin() {
        return view('auth.login');
    }

    // Owner login->post
    public function postLogin(LoginRequest $request) {
        $loginDetail = $request->validated();
        $email = $this->owner->where('email',$request->email)->first();
        if($email) {
            $password = $this->owner->where('password',$request->password)->first();
            $request->session()->put('id',$email->id);
            return redirect('/bmc');
        } else {
            return redirect('/register');
        }
    }

    // owner logout->get
    public function logout() {
        Session::flush();
        return redirect('/login');
    }

    // Owner profile

    // Owner view profile-page->get
    public function viewProfile() {
        $ownerId = Session::get('id');
        $detail = $this->ownerDetail->where('owner_id',$ownerId)->first();
        $proof = $this->ownerProof->where('owner_detail_id',$detail->id)->first();
        return view('/dashboard',compact('detail','proof'));
    }

    // Owner update profile->post
    public function updateProfile(OwnerProfileRequest $request) {
        try{
            if (request()->hasFile('photo')) {   
                $image = $this->commonImageUpload($request->photo, 'owner-image');
            }
            $ownerId = Session::get('id');
            $data = $request->except(['photo']);
            $data1=array_merge($data, ['owner_image'=>$image, 'owner_id'=>$ownerId]);
            $store = $this->ownerDetail->create($data1);
            return back()->with('success','Profile updated successfully!');
            }
        catch(Exception $exception) {
            Log::error('Profile update error'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Deleting owner->get
    public function deleteOwner($id) {
        Session::flush();
        $deletOwner = $this->owner->where('id',$id)->delete();
    }

    
}
