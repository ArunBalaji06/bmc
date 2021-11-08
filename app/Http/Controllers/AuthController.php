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
use App\Helpers\UuidModel;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    use imageUpload, UuidModel;
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
    public function postRegister(Request $request) {
    
        $password = $request->password;
        $confirmPassword = $request->confirm_password;
        if (request()->hasFile('photo')) {   
            $image1 = $this->commonImageUpload($request->photo, 'owner-image');
        }
        if (request()->hasFile('owner_proof_front')) {   
            $image2 = $this->commonImageUpload($request->owner_proof_front, 'owner-proof-front');
        }
        if (request()->hasFile('owner_proof_back')) {   
            $image3 = $this->commonImageUpload($request->owner_proof_back, 'owner-proof-back');
        }
        if($password == $confirmPassword) {
            $validate = $this->owner->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->confirm_password,
            ]);
            $sessionId = $this->owner->where('email',$request->email)->first();
            $request->session()->put('id',$sessionId->id);
            $ownerId = Session::get('id');
            $details = $this->ownerDetail->create([
                'owner_id' => $ownerId,
                'owner_image' => $image1,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]);

            $proof = $this->ownerProof->create([
                'owner_detail_id' => $details->id,
                'owner_proof_front' => $image2,
                'owner_proof_back' => $image3
            ]); 
            
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
        return redirect('/owner-login');
    }

    // Owner proof
    public function proofOwner(Request $request) {
        try{
            $ownerId = Session::get('id');
            if (request()->hasFile('owner_proof_front')) {   
                $image1 = $this->commonImageUpload($request->photo, 'owner-proof-front');
            }
            if (request()->hasFile('owner_proof_back')) {   
                $image2 = $this->commonImageUpload($request->photo, 'owner-proof-back');
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
    
        $detail = $this->ownerDetail->where('owner_id',$ownerId)->with('owner')->first();
        $proof = $this->ownerProof->where('owner_detail_id',$detail->id)->first();
        // dd($detail);
        // $proof = $this->ownerProof->where('owner_detail_id',$detail->id)->first();
        return view('owner.owner-profile',compact('detail','proof'));
    }

    // Owner update profile->post
    public function updateProfile(Request $request) {
        try{
            // dd($request);
            $ownerId = Session::get('id');
            $owenrDetailId = $this->ownerDetail->where('owner_id',$ownerId)->first();
            $ownerProofs = $this->ownerProof->where('owner_detail_id',$owenrDetailId->id)->first();
            // dd($ownerProofs);
            $img['photo'] = $owenrDetailId->owner_image;
            $img['owner_proof_front'] = $ownerProofs->owner_proof_front;
            $img['owner_proof_back'] = $ownerProofs->owner_proof_back;
            
            if (request()->hasFile('photo') || request()->hasFile('owner_proof_front') || request()->hasFile('owner_proof_back')) {

                $this->updatingImage($img,$request);
                $image  = $request->has('photo') ? $this->commonImageUpload($request->photo, 'owner-image') : $img['photo'];
                $image1 = $request->has('owner_proof_front') ? $this->commonImageUpload($request->owner_proof_front, 'owner-proof-front') : $img['owner_proof_front'];
                $image2 = $request->has('owner_proof_back') ? $this->commonImageUpload($request->owner_proof_back, 'owner-proof-back') : $img['owner_proof_back'];
            } else {
                $image = $img['photo'];
                $image1 = $img['owner_proof_front'];
                $image2 = $img['owner_proof_back'];
            }

            $mainDetail = $this->owner->where('id',$ownerId)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            $findOwner = $this->ownerDetail->where('owner_id',$ownerId)->update([
                'owner_id'     => $ownerId,
                'phone_number' => $request->phone_number,
                'address'      => $request->address,
                'owner_image'  => $image
            ]);
            // dd($owenrDetailId->id);
            $findProof = $this->ownerProof->where('owner_detail_id',$owenrDetailId->id)->update([
                'owner_detail_id'   => $owenrDetailId->id,
                'owner_proof_front' => $image1,
                'owner_proof_back'  => $image2
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
