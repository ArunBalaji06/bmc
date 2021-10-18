<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProof extends Model
{
    use HasFactory, Uuid;
    protected $table='client_proofs';
    protected $fillable = 
    ['client_proof_front','client_proof_back'];
}
