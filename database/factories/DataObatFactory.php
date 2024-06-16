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

        // Generate random even number between 5,000 to 50,000 for selling price
        $harga_jual = $faker->numberBetween(5000, 50000);
        $harga_jual = $harga_jual % 2 === 0 ? $harga_jual : $harga_jual + 1;

        // Generate random number between 100,000 to 150,000 for purchase price
        $harga_beli = $faker->numberBetween(100000, 150000);

        return [
            'kode' => $faker->unique()->randomNumber(6),
            'nama_obat' => $faker->randomElement([
                'Parasetamol',
                'Ibuprofen',
                'Omeprazole',
                'Ranitidine',
                'Simvastatin',
                'Metformin',
                'Amlodipine',
                'Aspirin',
                'Amoxicillin',
                'Cetirizine',
                'Loratadine',
                'Prednisone',
                'Atorvastatin',
                'Lisinopril',
                'Metoprolol',
                'Ciprofloxacin',
                'Fluoxetine',
                'Sertraline',
                'Gabapentin',
                'Albuterol'
            ]),
            'jenis_obat' => $faker->word(),
            'stok' => $faker->randomNumber(3),
            'harga_jual' => $harga_jual,
            'harga_beli' => $harga_beli,
            'expired' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}
