<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run () : void
    {
        RumahSakit::factory ( 50 )->create ();
    }
}
