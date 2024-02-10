<?php

namespace App\Livewire;

use App\Models\DataObat;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddTransaksiMasuk extends Component
{
    public $tasks = [];
    public $trow = 10;
    public $idBeingRemoved = null;
    public $sumharga = 0;
    public $idobat;
    public $show;
    public $transaksi;
    public $states = [];
    public $detail;
    public $state = [
        'id' => '',
        'jenis_obat' => '',
        'kode' => '',
        'nama_obat' => '',
        'hargabeli' => '',
        'hargajual' => '',
        'quantity' => '',
        'stok' => '',
        'total' => 0,
        'expired' => '',
    ];
    public function addNew()
    {
        $this->states = [];
        $this->dispatch('show-form');
    }
    function generateRandomInvoice()
    {
        $prefix = 'INV';  // Prefix untuk invoice
        $randomNumber = mt_rand(1000, 9999);  // Angka acak antara 1000 dan 9999
        $date = date('Ymd');  // Tanggal dalam format Ymd (contoh: 20240201)

        $invoiceNumber = $prefix . $date . $randomNumber;

        return $invoiceNumber;
    }
    public function savetodb()
    {
        if ($this->tasks == null) {
            dd('error');
            // $this->dispatch('show', ['message' => 'added successfully!', 'icon' => 'success']);
        }
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::create([
                'status' => 'Masuk',
                'invoice' => $this->generateRandomInvoice(),
                'tanggal' => now()
            ]);
            $this->transaksi = $transaksi;
            $collect = collect($this->tasks);

            // Loop melalui setiap obat dalam transaksi
            $collect->each(function ($obat) use ($transaksi) {
                // Kurangi stok obat berdasarkan kuantitas yang dijual
                $obatModel = DataObat::find($obat['id']);

                if ($obatModel) {
                    $newStok = $obatModel->stok - $obat['quantity'];

                    // Pastikan stok tidak menjadi negatif
                    $obatModel->stok = max(0, $newStok);
                    $obatModel->save();
                }

                // Simpan detail transaksi
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'data_obat_id' => $obat['id'],
                    'quantity' => $obat['quantity'],
                    'harga_jual' => $obat['harga'],
                    'harga_beli' => $obat['harga'],
                    'total_price' => $obat['total'],
                    'expired' => $obat['expired'],
                ]);
            });
            $this->show = true;
            $this->sumharga = 0;
            $this->detail = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
            $this->tasks = [];
            $this->state = [
                'id' => '',
                'jenis_obat' => '',
                'kode' => '',
                'nama_obat' => '',
                'harga' => '',
                'quantity' => '',
                'stok' => '',
                'total' => 0, // Reset total ke 0 setelah data obat ditambahkan
                'expired' => '',
            ];
            $this->dispatch('show', ['message' => 'added successfully!', 'icon' => 'success']);
            // If everything is successful, commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            // Optionally, you can log the error or handle it in another way
            // \log::error('Database transaction error: ' . $e->getMessage());
        }
    }
    public function addTask()
    {
        // Validasi formulir sebelum menambahkannya ke dalam array
        $this->validate([
            'state.quantity' => 'required|numeric',
        ]);



        // Periksa jika jumlah yang diminta melebihi stok
        if ($this->state['stok'] < $this->state['quantity']) {
            return $this->dispatch('allert', ['message' => 'Stok tidak mencukupi', 'icon' => 'warning']);
        }

        // Periksa jika id obat sudah ada dalam tasks
        if (collect($this->tasks)->contains('id', $this->idobat)) {
            $this->state = [
                'id' => '',
                'jenis_obat' => '',
                'kode' => '',
                'nama_obat' => '',
                'hargabeli' => '',
                'hargajual' => '',
                'quantity' => '',
                'stok' => '',
                'total' => 0, // Reset total ke 0 setelah data obat ditambahkan
                'expired' => '',
            ];
            return $this->dispatch('allert', ['message' =>
            'ID obat sudah ada dalam tasks', 'icon' => 'error']);
        }

        // Menambahkan harga obat ke total harga
        $this->state['total'] += $this->state['hargabeli'] * $this->state['quantity'];
        $this->tasks[] = $this->state;
        // Menambahkan harga obat ke total harga
        $this->sumharga += $this->state['total'];
        $this->idobat = '';
        // Reset formulir ke nilai awal
        $this->state = [
            'id' => '',
            'jenis_obat' => '',
            'kode' => '',
            'nama_obat' => '',
            'hargabeli' => '',
            'hargajual' => '',
            'quantity' => '',
            'stok' => '',
            'total' => 0, // Reset total ke 0 setelah data obat ditambahkan
            'expired' => '',
        ];
        session()->flash('message', 'Data obat berhasil ditambahkan.');
    }
    public function addTaskDb()
    {
        // Validasi formulir sebelum menambahkannya ke dalam array
        $this->validate([
            'state.quantity' => 'required|numeric',
            'state.jenis_obat' => 'required',
            'state.kode' => 'required|unique:data_obats,kode', // Unique validation rule for 'kode' field in 'data_obats' table
            'state.nama_obat' => 'required|unique:data_obats,nama_obat', // Unique validation rule for 'nama_obat' field in 'data_obats' table
            'state.hargabeli' => 'required',
            'state.hargajual' => 'required',
            'state.expired' => 'required',
        ]);
        $data = DataObat::create([
            'kode' => $this->state['kode'],
            'jenis_obat' => $this->state['jenis_obat'],
            'nama_obat' => $this->state['nama_obat'],
            'harga_beli' => $this->state['hargabeli'],
            'harga_jual' => $this->state['hargajual'],
            'stok' => $this->state['quantity'],
            'expired' => $this->state['expired'],
        ]);
        // Menambahkan harga obat ke total harga
        $this->state['total'] += $this->state['hargabeli'] * $this->state['quantity'];
        $this->tasks[] = [
            'id' => $data->id,
            'jenis_obat' => $this->state['jenis_obat'],
            'kode' => $this->state['kode'],
            'nama_obat' => $this->state['nama_obat'],
            'hargabeli' => $this->state['hargabeli'],
            'hargajual' => $this->state['hargajual'],
            'quantity' => $this->state['quantity'],
            'total' =>  $this->state['total'],
            'expired' => $data->expired,
        ];
        // Menambahkan harga obat ke total harga
        $this->sumharga += $this->state['total'];
        $this->idobat = '';
        // Reset formulir ke nilai awal
        $this->state = [
            'id' => '',
            'jenis_obat' => '',
            'kode' => '',
            'nama_obat' => '',
            'harga' => '',
            'quantity' => '',
            'stok' => '',
            'total' => 0, // Reset total ke 0 setelah data obat ditambahkan
            'expired' => '',
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

    public function removeTask($index)
    {
        // Menghapus data obat dari array
        $removedTask = array_splice($this->tasks, $index, 1)[0];
        // Mengurangkan harga obat yang dihapus dari total harga
        $this->sumharga -= $removedTask['total'];
        $obat = DataObat::findOrFail($removedTask['id']);
        $obat->delete();
        // Optional: Tambahkan pesan sukses atau umpan balik lainnya
        session()->flash('message', 'Data obat berhasil dihapus.');
    }
    public function render()
    {
        $dataobat = DataObat::find($this->idobat);
        if ($dataobat != null) {
            $this->state = [
                'id' => $dataobat->id,
                'jenis_obat' => $dataobat->jenis_obat,
                'kode' => $dataobat->kode,
                'nama_obat' => $dataobat->nama_obat,
                'hargabeli' => intval($dataobat->harga_beli),
                'hargajual' => intval($dataobat->harga_jual),
                'stok' => $dataobat->stok,
                'quantity' => 1,
                'total' => 0, // Reset total ke 0 setelah data obat ditambahkan
                'expired' => $dataobat->expired,
            ];
        }
        return view('livewire.add-transaksi-masuk');
    }
}
