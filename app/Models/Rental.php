<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory, Uuid;
    protected $table='rentals';
    protected $fillable = 
    ['receive_destination','receive_at','return_destination','return_at'];
}
