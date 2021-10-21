<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rental;
use App\Models\Payment;

class Damage extends Model
{
    use HasFactory, Uuid;
    protected $table='damages';
    protected $fillable = 
    ['rental_id','payment_id','damage_description','price_for_damage'];

    public function rental() {
        return $this->belongsTo(Rental::class,'rental_id','id');
    }

    public function payment() {
        return $this->belongsTo(Payment::class,'payment_id','rental_id');
    }
}
