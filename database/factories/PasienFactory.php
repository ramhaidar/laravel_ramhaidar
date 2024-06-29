<?php

namespace Database\Factories;

use App\Models\RumahSakit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition () : array
    {
        // return [ 
        //     'nama_pasien'    => $this->faker->name,
        //     'alamat'         => $this->faker->address,
        //     'no_telepon'     => $this->faker->phoneNumber,
        //     'rumah_sakit_id' => RumahSakit::factory (),
        // ];

        return [ 
            'nama_pasien' => $this->faker->name,
            'alamat'      => $this->faker->address,
            'no_telepon'  => $this->faker->phoneNumber,
            // 'rumah_sakit_id' => RumahSakit::factory(), // ini akan diisi oleh seeder
        ];
    }
}
