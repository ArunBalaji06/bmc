<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OwnerDetail;

class OwnerProof extends Model
{
    use HasFactory, Uuid;
    protected $table='owner_proofs';
    protected $fillable = 
    ['owner_detail_id','owner_proof_front','owner_proof_back'];

    public function ownerDetail() {
        return $this->belongsTo(OwnerDetail::class,'owner_detail_id','id');
    }
}
