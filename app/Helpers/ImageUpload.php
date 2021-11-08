<?php

namespace App\Helpers;
use Illuminate\Support\Facades\File;

trait imageUpload {
     /**
     * Common Image Upload Function
     * @param $attachment
     * @param $type
     * @return string
     */
    public function commonImageUpload($attachment, $type): string
    {
        /** Laravel file helper methods */
        $attachmentExtension = $attachment->getClientOriginalExtension();
        $attachmentMimeType = $attachment->getClientMimeType();
        $attachmentName = $attachment->getClientOriginalName();
        $attachmentSize = $attachment->getSize();
        
        /** New attachment name, v - milliseconds */
        $attachmentNewName = 'bmc.' .date('YmdHisv'). '.' .$attachmentName ;
        // dd($attachmentNewName);

        /** Instead of storage I will demo you storing in PUBLIC path same as that of assets folder */
        if ($type == 'owner-register-car') {
            $uploadPath = public_path() . '/owner/registered-car';
        } elseif($type == 'owner-image') {
            $uploadPath = public_path() . '/owner/profile-image';
        } elseif($type == 'owner-proof-front') {
            $uploadPath = public_path() . '/owner/proofs-front';
        } elseif($type == 'owner-proof-back') {
            $uploadPath = public_path() . '/owner/proofs-back';
        } elseif($type == 'client-image') {
            $uploadPath = public_path() . '/client/client-image';
        } elseif($type == 'client-proof-front') {
            $uploadPath = public_path() . '/client/proofs-front';
        } elseif($type == 'client-proof-back') {
            $uploadPath = public_path() . '/client/proofs-back';
        }

        /** Moving the uploaded path of public folder */
        $attachment->move($uploadPath, $attachmentNewName);
        return $attachmentNewName;
    }

    public function updatingImage($img,$req) {
        if($req->hasFile('photo')) {
            if(File::exists(public_path('owner/profile-image/'.$img['photo']))){
                File::delete(public_path('owner/profile-image/'.$img['photo']));
            }
        }
        if($req->hasFile('owner_proof_front')) {
            if(File::exists(public_path('owner/proofs-front/'.$img['owner_proof_front']))){
                File::delete(public_path('owner/proofs-front/'.$img['owner_proof_front']));
            }
        }
        if($req->hasFile('owner_proof_back')) {
            if(File::exists(public_path('owner/proofs-back/'.$img['owner_proof_back']))){
                File::delete(public_path('owner/proofs-back/'.$img['owner_proof_back']));
            }
        }
        if($req->hasFile('car_image')) {
            if(File::exists(public_path('owner/registered-car/'.$img['car_image']))){
                File::delete(public_path('owner/registered-car/'.$img['car_image']));
            }
        }
    }

    public function clientImageUpdate($img,$req) {
        // dd($img);
        if($req->hasFile('client_image')) {
            if(File::exists(public_path('client/client-image/'.$img['client_image']))){
                File::delete(public_path('client/client-image/'.$img['client_image']));
            }
        }
        if($req->hasFile('client_proof_front')) {
            if(File::exists(public_path('client/proofs-front/'.$img['client_proof_front']))){
                File::delete(public_path('client/proofs-front/'.$img['client_proof_front']));
            }
        }
        if($req->hasFile('client_proof_back')) {
            if(File::exists(public_path('client/proofs-back/'.$img['client_proof_back']))){
                File::delete(public_path('client/proofs-back/'.$img['client_proof_back']));
            }
        }
    }
}
