<?php

namespace Database\Factories;

use App\Models\DataObat;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaksi>
 */
class DetailTransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        $transaksi = Transaksi::inRandomOrder()->first();
        $obat = DataObat::inRandomOrder()->first();
        $quantity = rand(1, 10); // Menggunakan fungsi rand() untuk mendapatkan nilai acak antara 1 dan 10
        $total_price = $quantity * $obat->harga_beli;

        return [
            'transaksi_id' => $transaksi->id,
            'data_obat_id' => $obat->id,
            'quantity' => $quantity,
            'harga_jual' => $obat->harga_jual,
            'harga_beli' => $obat->harga_beli,
            'total_price' => $total_price,
            'expired' => $obat->expired,
        ];
    }
}
