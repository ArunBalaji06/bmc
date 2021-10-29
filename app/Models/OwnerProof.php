<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OwnerDetail;
use App\Helpers\UuidModel;

class OwnerProof extends Model
{
    use HasFactory, UuidModel;
    protected $table='owner_proofs';
    protected $fillable = 
    ['owner_detail_id','owner_proof_front','owner_proof_back'];

    public function ownerDetail() {
        return $this->belongsTo(OwnerDetail::class,'owner_detail_id','id');
    }
}
