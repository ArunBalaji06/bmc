<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Damage;
use App\Models\Complain;

class Rental extends Model
{
    use HasFactory, Uuid;
    protected $table='rentals';
    protected $fillable = 
    ['receive_destination','receive_at','return_destination','return_at'];

    public function payment() {
        return $this->belongsTo(Payment::class,'payment_id','id');
    }

    public function damage() {
        return $this->hasMany(Damage::class,'rental_id','id');
    }

    public function complain() {
        return $this->hasMany(Complain::class,'rental_id','id');
    }
}
