<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;
use App\Models\OwnerProof;
use App\Helpers\UuidModel;

class OwnerDetail extends Model
{
    use HasFactory, UuidModel;
    protected $table='owner_details';
    protected $fillable = 
    ['owner_id','owner_image','phone_number','address'];

    public function owner() {
        return $this->belongsTo(Owner::class,'owner_id','id');
    }

    public function ownerProof() {
        return $this->hasMany(ownerProof::class,'owner_detail_id');
    }
}
