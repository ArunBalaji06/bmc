<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;
use App\Models\Client;
use App\Models\Car;
use App\Models\Payment;
use App\Helpers\UuidModel;


class Requests extends Model
{
    use HasFactory, UuidModel;
    protected $table='requests';
    protected $fillable = 
    ['owner_id','client_id','car_id','status'];

    public function owner() {
        return $this->belongsTo(Owner::class,'owner_id','id');
    }

    public function client() {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function car() {
        return $this->belongsTo(Car::class,'car_id','id');
    }

    public function payment() {
        return $this->hasMany(Payment::class,'request_id','id');
    }
}
