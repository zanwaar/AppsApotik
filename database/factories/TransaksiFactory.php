<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create();
        $startDate = strtotime('2023-12-27');
        $endDate = strtotime('now');

        return [
            'status' => $faker->randomElement(['Keluar', 'Masuk']),
            'invoice' => $this->generateRandomInvoice(),
            'tanggal' => date('Y-m-d', mt_rand($startDate, $endDate)),
        ];
    }
    function generateRandomInvoice()
    {
        $prefix = 'INV';  // Prefix untuk invoice
        $randomNumber = mt_rand(1000, 9999);  // Angka acak antara 1000 dan 9999
        $date = date('Ymd');  // Tanggal dalam format Ymd (contoh: 20240201)

        $invoiceNumber = $prefix . $date . $randomNumber;

        return $invoiceNumber;
    }
}
