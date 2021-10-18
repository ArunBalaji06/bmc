<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    use HasFactory, Uuid;
    protected $table='client_details';
    protected $fillable = 
    ['phone_number','address'];
}
