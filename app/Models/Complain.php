<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rental;

class Complain extends Model
{
    use HasFactory, Uuid;
    protected $table='complains';
    protected $fillable = 
    ['rental_id','complain_description'];

    public function rental() {
        return $this->belongsTo(Rental::class,'rental_id','id');
    }
}
