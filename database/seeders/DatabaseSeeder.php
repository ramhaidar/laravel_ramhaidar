<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run () : void
    {
        // Buat 50 user
        User::factory ( 50 )->create ();

        // Buat 10 Rumah Sakit
        $rumahSakit = RumahSakit::factory ( 10 )->create ();

        // Dapatkan ID Rumah Sakit yang sudah dibuat
        $rumahSakitIds = $rumahSakit->pluck ( 'id' )->toArray ();

        // Buat 150 Pasien dan assign ke Rumah Sakit yang sudah ada
        foreach ( range ( 1, 150 ) as $index )
        {
            Pasien::factory ()->create ( [ 
                'rumah_sakit_id' => $rumahSakitIds[ array_rand ( $rumahSakitIds ) ],
            ] );
        }

        // Panggil seeder lain jika diperlukan
        $this->call ( [ 
            UserSeeder::class,
            // PasienSeeder::class,
            // RumahSakitSeeder::class
        ] );
    }
}
