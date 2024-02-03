<?php

namespace App\Livewire;

use App\Models\DetailTransaksi as ModelsDetailTransaksi;
use App\Models\Transaksi;
use Livewire\Component;

class DetailTransaksi extends Component
{
    public $idtransaksi;
    public function mount($id)
    {
        $this->idtransaksi = $id;
    }
    public function getDetailtransaksiProperty()
    {
        return ModelsDetailTransaksi::where('transaksi_id', $this->idtransaksi)->get();
    }
    public function rupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
    public function render()
    {
        // dd($this->detail);
        $transaksi = Transaksi::where('id', $this->idtransaksi)->first();
        // dd($transaksi->total_price);
        return view('livewire.detail-transaksi', ['detail' => $this->Detailtransaksi, 'transaksi' => $transaksi]);
    }
}
