<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DivisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_divisi' => $this->faker->unique()->word,
            'deskripsi_divisi' => $this->faker->sentence,
        ];
    }
}
