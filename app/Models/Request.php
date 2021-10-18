<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory, Uuid;
    protected $table='requests';
    protected $fillable = 
    ['status'];
}
