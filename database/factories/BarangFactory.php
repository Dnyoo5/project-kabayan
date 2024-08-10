<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'nama_barang'=>fake()->randomElement(['Sweeter','Colokan','Jaket','Mobil','Motor','helm','gelas','jilbab','piring','botol','mouse','tv']),
          'kategori'=>fake()->randomElement(['Pakaian','Elektronik','Peralatan Rumah']),
          'jumlah'=>fake()->randomDigitNot(0),
        ];
    }
}
