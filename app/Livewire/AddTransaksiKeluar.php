<?php

namespace App\Livewire;

use Livewire\Component;

class AddTransaksiKeluar extends Component
{
    public $tasks = [];
    public $sumharga = 0;
    public $state = [
        'jenis_obat' => '',
        'kode' => '',
        'nama_obat' => '',
        'harga' => '',
        'quantity' => '',
        'total' => 0,
    ];

    public function addTask()
    {
        // Validasi formulir sebelum menambahkannya ke dalam array
        $this->validate([
            'state.jenis_obat' => 'required',
            'state.kode' => 'required',
            'state.nama_obat' => 'required',
            'state.harga' => 'required|numeric',
            'state.quantity' => 'required|numeric',
        ]);

        // Menambahkan harga obat ke total harga
        $this->state['total'] += $this->state['harga'] * $this->state['quantity'];
        $this->tasks[] = $this->state;
        // Menambahkan harga obat ke total harga
        $this->sumharga += $this->state['total'];

        // Reset formulir ke nilai awal
        $this->state = [
            'jenis_obat' => '',
            'kode' => '',
            'nama_obat' => '',
            'harga' => '',
            'quantity' => '',
            'total' => 0, // Reset total ke 0 setelah data obat ditambahkan
        ];
        session()->flash('message', 'Data obat berhasil ditambahkan.');
    }

    public function editTask($index)
    {
        // Mengisi formulir dengan data obat yang ingin diperbarui
        $this->state = $this->tasks[$index];
        // Menghapus data yang ingin diperbarui dari array
        unset($this->tasks[$index]);
        // Optional: Tambahkan pesan atau umpan balik lainnya
    }

    public function updateTask()
    {
        // Validasi formulir sebelum memperbarui data
        $this->validate([
            'state.jenis_obat' => 'required',
            'state.kode' => 'required',
            'state.nama_obat' => 'required',
            'state.harga' => 'required|numeric',
            'state.quantity' => 'required|numeric',
        ]);

        // Menambahkan data obat yang diperbarui ke dalam array $tasks  // Menambahkan harga obat ke total harga
        $this->sumharga += $this->state['harga'] * $this->state['quantity'];


        $this->tasks[] = $this->state;




        // Reset formulir ke nilai awal
        $this->state = [];

        // Optional: Tambahkan pesan sukses atau umpan balik lainnya
        session()->flash('message', 'Data obat berhasil diperbarui.');
    }

    public function removeTask($index)
    {
        // Menghapus data obat dari array
        $removedTask = array_splice($this->tasks, $index, 1)[0];

        // Mengurangkan harga obat yang dihapus dari total harga
        $this->sumharga -= $removedTask['total'];

        // Optional: Tambahkan pesan sukses atau umpan balik lainnya
        session()->flash('message', 'Data obat berhasil dihapus.');
    }
    public function render()
    {
        return view('livewire.add-transaksi-keluar');
    }
}
