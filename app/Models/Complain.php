<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory, Uuid;
    protected $table='complains';
    protected $fillable = 
    ['complain_description'];
}
