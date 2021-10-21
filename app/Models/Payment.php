<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
use App\Models\Rental;
use App\Models\Damage;

class Payment extends Model
{
    use HasFactory, Uuid;
    protected $table='payments';
    protected $fillable = 
    ['days','price','advance_payment','total_payment','rental','damage_amount','damage_payment_status'];

    public function request() {
        return $this->belongsTo(Request::class,'request_id','id');
    }

    public function rental() {
        return $this->hasMany(Rental::class,'payment_id','id');
    }

    public function damage() {
        return $this->hasMany(Damage::class,'payment_id','id');
    }
}
