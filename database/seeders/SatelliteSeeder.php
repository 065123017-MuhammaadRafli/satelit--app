<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satellite;

class SatelliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel satelit terlebih dahulu agar tidak duplikat saat di-seed ulang
        Satellite::truncate();

        $satellites = [
            [
                'ground_station_id' => 1, // Pastikan ID 1 adalah Stasiun Bumi Rancabungur di database kamu
                'name'              => 'LAPAN-TUBSAT (LAPAN-A1)',
                'country'           => 'Indonesia',
                'orbit_type'        => 'LEO',
                'altitude'          => 630, // Estimasi ketinggian dalam KM
                'tle'               => "1 29709U 07001A   26130.88125376  .00000550  00000+0  69612-4 0  9994\n2 29709  98.1350 129.2664 0011111 312.3840  47.6433 14.85912519 45619",
            ],
            [
                'ground_station_id' => 1,
                'name'              => 'LAPAN-A2 (ORARI)',
                'country'           => 'Indonesia',
                'orbit_type'        => 'LEO',
                'altitude'          => 650, // Satelit ekuatorial
                'tle'               => "1 40931U 00000    26131.02275463  .00000000  00000-0 -12415-2 0    08\n2 40931   5.9991  75.7095 0012645 205.0834  75.8077 14.79203565 28203",
            ],
            [
                'ground_station_id' => 1,
                'name'              => 'LAPAN-A3 (IPB)',
                'country'           => 'Indonesia',
                'orbit_type'        => 'LEO',
                'altitude'          => 505, // Satelit polar / sun-synchronous
                'tle'               => "1 41603U 16040E   26130.85389569  .00002601  00000+0  84148-4 0  9997\n2 41603  97.1491 128.2353 0011503 141.3371 218.8697 15.32868575549099",
            ],
        ];

        foreach ($satellites as $sat) {
            Satellite::create($sat);
        }
    }
}
