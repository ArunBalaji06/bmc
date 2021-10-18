<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory, Uuid;
    protected $table='damages';
    protected $fillable = 
    ['damage_description','price_for_damage'];
}
