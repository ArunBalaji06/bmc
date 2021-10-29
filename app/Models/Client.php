<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Requests;
use App\Models\ClientDetail;
use App\Helpers\UuidModel;


class Client extends Model
{
    use HasFactory, UuidModel;
    protected $table='clients';
    protected $fillable = 
    ['name','email','password'];

    public function request() {
        return $this->hasMany(Requests::class,'client_id','id');
    }

    public function clientDetail() {
        return $this->hasMany(ClientDetail::class,'client_id','id');
    }
}
