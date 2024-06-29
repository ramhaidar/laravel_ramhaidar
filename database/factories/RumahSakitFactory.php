<?php

namespace Database\Factories;

use App\Models\RumahSakit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RumahSakit>
 */
class RumahSakitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition () : array
    {
        return [ 
            'nama_rumah_sakit' => $this->faker->company,
            'alamat'           => $this->faker->address,
            'email'            => $this->faker->unique ()->safeEmail,
            'telepon'          => $this->faker->phoneNumber,
        ];
    }
}
