<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\UuidModel;

class Car extends Model
{
    use HasFactory, UuidModel;
    protected $table='cars';
    protected $fillable = 
    ['owner_id','model','seating_capacity','price','photo','availability'];
}
