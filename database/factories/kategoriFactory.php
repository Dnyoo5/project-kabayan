<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kategori>
 */
class kategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'kategori'=> fake()->randomElement(['Pakaian','Elektronik','Peralatan Rumah','Kendaraan','Purnitur','Perhiasan']),
        ];
    }
}
