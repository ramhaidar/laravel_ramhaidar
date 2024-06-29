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
        $rumahSakit = RumahSakit::factory ( 10 )->create ();

        $rumahSakitIds = $rumahSakit->pluck ( 'id' )->toArray ();

        foreach ( range ( 1, 150 ) as $index )
        {
            Pasien::factory ()->create ( [ 
                'rumah_sakit_id' => $rumahSakitIds[ array_rand ( $rumahSakitIds ) ],
            ] );
        }

        $this->call ( [ 
            UserSeeder::class,
        ] );
    }
}
