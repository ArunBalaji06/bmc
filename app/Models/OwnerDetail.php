<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerDetail extends Model
{
    use HasFactory, Uuid;
    protected $table='owner_details';
    protected $fillable = 
    ['phone_number','address'];
}
