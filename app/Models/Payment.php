<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, Uuid;
    protected $table='payments';
    protected $fillable = 
    ['days','price','advance_payment','total_payment','rental','damage_amount','damage_payment_status'];
}
