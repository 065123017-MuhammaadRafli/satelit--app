<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;

class GroundStation extends Model
{
   protected $fillable = ['name', 'location', 'country', 'latitude', 'longitude'];

   public function satellites()
   {
       return $this->hasMany(Satellite::class);
   }
}
