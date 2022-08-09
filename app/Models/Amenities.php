<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{

    protected $guarded=['id'];
    public $table="amenities";
    public function advertising()
    {
        return $this->belongsToMany(Advertising::class,'amenities_advertising','amenities_id');
    }
}
