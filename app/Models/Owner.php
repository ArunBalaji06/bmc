<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\UuidModel;

class Owner extends Model
{
    use HasFactory, UuidModel;
    protected $table='owners';
    protected $fillable = 
    ['name','email','password'];
}
