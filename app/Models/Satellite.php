<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satellite extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = [
        'ground_station_id', 'name', 'owner_country',
        'launch_date', 'orbit_type', 'tle', 'is_active', 'description'
    ];

    // Relasi: Satelit ini milik satu Ground Station
    public function groundStation()
    {
        return $this->belongsTo(GroundStation::class);
    }
}
