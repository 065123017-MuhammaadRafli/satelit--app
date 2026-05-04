<?php

namespace Database\Seeders;

use App\Models\GroundStation;
use App\Models\Satellite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Data Stasiun Bumi Dummy
        $gs = GroundStation::create([
            'name'      => 'GS-Biak-01',
            'location'  => 'Biak, Papua',
            'country'   => 'Indonesia',
            'latitude'  => -1.1833,
            'longitude' => 136.1333,
        ]);

        // 2. Buat Data Satelit Dummy dengan TLE
        Satellite::create([
            'ground_station_id' => $gs->id,
            'name'              => 'LAPAN-A2',
            'owner_country'     => 'Indonesia',
            'launch_date'       => '2015-09-28',
            'orbit_type'        => 'LEO',
            'is_active'         => true,
            'tle'               => "1 40931U 15052B   26123.12345678  .00000123  00000-0  34567-4 0  9999\n2 40931  97.4567 125.1234 0012345 180.1234 220.5678 14.56789012345678",
        ]);

        // 3. Tambahan Satelit Kedua
        Satellite::create([
            'ground_station_id' => $gs->id,
            'name'              => 'Telkom-3S',
            'owner_country'     => 'Indonesia',
            'launch_date'       => '2017-02-14',
            'orbit_type'        => 'GEO',
            'is_active'         => true,
            'tle'               => "1 42001U 17009A   26123.12345678  .00000000  00000-0  00000-0 0  9999\n2 42001   0.0543 118.0123 0001234 250.3210 170.1234  1.002745678",
        ]);
    }
}
