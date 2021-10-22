<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\UuidModel;
use App\Models\Car;
use App\Models\Requests;
use App\Models\OwnerDetail;

class Owner extends Model
{
    use HasFactory, UuidModel;
    protected $table='owners';
    protected $fillable = 
    ['name','email','password'];

    public function car() {
        return $this->hasMany(Car::class,'owner_id','id');
    }

    public function request() {
        return $this->hasMany(Requests::class,'owner_id','id');
    }

    public function ownerDetail() {
        return $this->hasMany(ownerDetail::class,'owner_id','id');
    }


}
