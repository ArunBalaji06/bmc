<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
use App\Models\ClientDetail;

class Client extends Model
{
    use HasFactory, Uuid;
    protected $table='clients';
    protected $fillable = 
    ['name','email','password'];

    public function request() {
        return $this->hasMany(Request::class,'client_id','id');
    }

    public function clientDetail() {
        return $this->hasMany(ClientDetail::class,'client_id','id');
    }
}
