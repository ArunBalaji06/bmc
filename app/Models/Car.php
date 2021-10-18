<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, Uuid;
    protected $table='cars';
    protected $fillable = 
    ['model','seating_capacity','price','availability'];
}
