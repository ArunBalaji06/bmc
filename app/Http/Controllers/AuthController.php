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

    // Owner profile->post
    public function firstProfile(OwnerProfileRequest $request) {
        try{
            if (request()->hasFile('photo')) {   
                $image = $this->commonImageUpload($request->photo, 'owner-image');
            }
            $findOwner = $this->ownerDetail->where('owner_id',$request->id)->create([
                'owner_id'     => $request->id,
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
                'photo'        => $image
            ]);
            return redirect('/view-owner-profile')->with('success','profile added successfully!');
            }
        catch(Exception $exception) {
            Log::error('Profile adding error'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Owner proof
    public function proofOwner(Request $request) {
        try{
            $ownerId = Session::get('id');
            if (request()->hasFile('owner_proof_front')) {   
                $image1 = $this->commonImageUpload($request->photo, 'owner-proof');
            }
            if (request()->hasFile('owner_proof_back')) {   
                $image2 = $this->commonImageUpload($request->photo, 'owner-proof');
            }
            $findDetail = $this->ownerDetail->where('owner_id',$ownerId)->first();
            $findOwner = $this->ownerProof->create([
                'owner_detail_id'     => $findDetail->id,
                'owner_proof_front' => $image1,
                'owner_proof_back'      => $image2,
            ]);
            return redirect('/view-owner-profile')->with('success','proof added successfully!');
        } catch(Exception $exception) {
            Log::error('Profile proof error'.$exception->getMessage());
            return back()->with('error',$exception->getMessage());
        }
    }

    // Owner view profile-page->get
    public function viewProfile() {
        $ownerId = Session::get('id');
        $detail = $this->ownerDetail->where('owner_id',$ownerId)->first();
        $proof = $this->ownerProof->where('owner_detail_id',$detail->id)->first();
        return view('owner.owner-profile',compact('detail','proof'));
    }

    // Owner update profile->post
    public function updateProfile(OwnerProfileRequest $request) {
        try{
            if (request()->hasFile('photo')) {   
                $image = $this->commonImageUpload($request->photo, 'owner-image');
            }
            $findOwner = $this->ownerDetail->where('owner_id',$request->id)->update([
                'owner_id'     => $ownerId,
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
                'photo'        => $image
            ]);
            return back()->with('success','Owner profile updated successfully');
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
