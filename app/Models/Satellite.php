<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satellite extends Model
{
    use HasFactory;

    /**
     * Menggunakan $guarded = [] berarti semua kolom boleh diisi (mass assignment).
     * Pastikan kolom di database Anda meliputi:
     * id, ground_station_id, name, country, launch_date, orbit_type, altitude, tle, is_active
     */
    protected $guarded = [];

    /**
     * Relasi ke Stasiun Bumi (Many-to-One)
     * Satu Satelit dipantau oleh satu Stasiun Bumi.
     * Pastikan foreign key di tabel satellites bernama 'ground_station_id'
     */
    public function groundStation()
    {
        return $this->belongsTo(GroundStation::class, 'ground_station_id');
    }

    /**
     * Aksesor: $satellite->tle_lines
     * Memecah data TLE mentah menjadi array per baris untuk mempermudah tampilan di detail.
     */
    public function getTleLinesAttribute()
    {
        if (!$this->tle) {
            return [];
        }

        // Membersihkan karakter \r agar konsisten, lalu pecah berdasarkan baris baru (\n)
        $cleanTle = str_replace("\r", "", $this->tle);

        // Menghasilkan array yang berisi Baris 1 dan Baris 2 TLE
        return array_filter(explode("\n", trim($cleanTle)));
    }

    /**
     * Aksesor: $satellite->status_label
     * Mendapatkan label status aktif dalam bentuk teks.
     */
    public function getStatusLabelAttribute()
    {
        // Jika kolom is_active adalah boolean (0/1)
        return $this->is_active ? 'Aktif' : 'Non-Aktif';
    }

    /**
     * Aksesor: $satellite->altitude_label
     * Menambahkan satuan Km secara otomatis saat menampilkan data.
     */
    public function getAltitudeLabelAttribute()
    {
        return $this->altitude ? $this->altitude . ' Km' : '-';
    }
}
