<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataObat;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
        ]);
        DataObat::factory()->count(20)->create();
        Transaksi::factory()->count(20)->create();
        DetailTransaksi::factory()->count(100)->create();
    }
}
