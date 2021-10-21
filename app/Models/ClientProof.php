<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientDetail;

class ClientProof extends Model
{
    use HasFactory, Uuid;
    protected $table='client_proofs';
    protected $fillable = 
    ['client_detail_id','client_proof_front','client_proof_back'];

    public function clientDetail() {
        return $this->belongsTo(ClientDetail::class,'client_detail_id','id');
    }
}
