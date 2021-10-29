<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\ClientProof;
use App\Helpers\UuidModel;

class ClientDetail extends Model
{
    use HasFactory, UuidModel;
    protected $table='client_details';
    protected $fillable = 
    ['client_id','client_image','phone_number','address'];

    public function client() {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function clientProof() {
        return $this->hasMany(ClientProof::class,'client_detail_id','id');
    }
}
