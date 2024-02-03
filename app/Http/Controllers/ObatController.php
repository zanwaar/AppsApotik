<?php

namespace App\Http\Controllers;

use App\Models\DataObat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        //get data products
        $dataobat = DataObat::when($request->input('kode'), function ($query, $name) {
            return $query->where('kode', 'like', '%' . $name . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        //sort by created_at desc

        return view('daftarobat', ['type_menu' => 'transaksi', 'dataobat' => $dataobat]);
    }
    public function store(Request $request)
    {
        // Validation logic if needed
        // $request->validate([
        //     'kode' => 'required',
        //     // Add more fields as needed
        // ]);
        $faker = \Faker\Factory::create();

        // Insert data into the database
        DataObat::create([
            'kode' => $faker->unique()->randomNumber(6),
            'nama_obat' => $faker->word(),
            'jenis_obat' => $faker->word(),
            'harga' => $faker->randomFloat(2, 1, 100), // Example of generating a random float for price
            'stok' => $faker->randomNumber(3), // Example of generating a random number for stock
            'expired' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'), // Example of generating a random expiration date
            // Add more fields as needed
        ]);

        // You can return a response if necessary
        return response()->json(['message' => 'Data saved successfully']);
    }
}
