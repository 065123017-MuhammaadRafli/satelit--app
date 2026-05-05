<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satellite extends Model
{
    protected $guarded = [];

    // Relasi ke Stasiun Bumi
    public function groundStation()
    {
        return $this->belongsTo(GroundStation::class);
    }

    // Fungsi untuk memecah TLE menjadi array
    public function getTleLinesAttribute()
    {
        if (!$this->tle_data) {
            return [];
        }

        // Memecah berdasarkan baris baru
        return array_filter(explode("\n", str_replace("\r\n", "\n", $this->tle_data)));
    }
}
