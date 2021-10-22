<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\UuidModel;
use App\Models\Owner;
use App\Models\Car;
use App\Models\Requests;

class Car extends Model
{
    use HasFactory, UuidModel;
    protected $table='cars';
    protected $fillable = 
    ['owner_id','model','seating_capacity','price','photo','availability'];


    public function owner(){
        return $this->belongsTo(Owner::class,'owner_id','id');
    }

    public function request(){
        return $this->hasMany(Requests::class,'car_id','id');
    }
}
