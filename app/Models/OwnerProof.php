<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerProof extends Model
{
    use HasFactory, Uuid;
    protected $table='owner_proofs';
    protected $fillable = 
    ['owner_proof_front','owner_proof_back'];
}
