<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataObat>
 */
class DataObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'kode' => $faker->unique()->randomNumber(6),
            'nama_obat' => $faker->word(),
            'jenis_obat' => $faker->word(),
            'stok' => $faker->randomNumber(3), // Example of generating a random number for stock
            'harga_jual' => $faker->randomNumber(6), // Contoh harga jual acak dengan 4 digit (misalnya, antara 1000 dan 9999)
            'harga_beli' => $faker->randomNumber(6),
            'expired' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'), // Example of generating a random expiration date
        ];
    }
}
