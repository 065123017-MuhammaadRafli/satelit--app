<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroundStation extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'location',
    'latitude',
    'longitude',
    'elevation', // Tambahkan ini
    'status'     // Tambahkan ini
];

    // Satu Ground Station dapat memantau banyak Satelit
    public function satellites()
    {
        return $this->hasMany(Satellite::class);
    }
}
