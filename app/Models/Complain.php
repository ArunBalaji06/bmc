<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rental;
use App\Helpers\UuidModel;

class Complain extends Model
{
    use HasFactory, UuidModel;
    protected $table='complains';
    protected $fillable = 
    ['rental_id','complain_description'];

    public function rental() {
        return $this->belongsTo(Rental::class,'rental_id','id');
    }
}
