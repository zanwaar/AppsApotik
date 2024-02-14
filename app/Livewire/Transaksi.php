<?php

namespace App\Livewire;

use App\Models\Transaksi as ModelsTransaksi;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $status = 'Keluar';
    public $statusbg = 'primary';
    public function addkeluar()
    {
        return redirect()->route('add-transaksi-keluar');
    }
    public function addmasuk()
    {
        return redirect()->route('add-transaksi-masuk');
    }
    public function getTransaksiProperty() 
    {
        return ModelsTransaksi::latest()->where(function ($query) {
            $query->where('status', $this->status);
        })->paginate(10);
    }
    public function filterStatus($status)
    {
        $this->status = $status;
        if ($this->status == 'Masuk') {
            $this->statusbg = 'success';
        } else {
            $this->statusbg = 'primary';
        }
    }
    public function render()
    {
        return view('livewire.transaksi', ['transaksi' => $this->transaksi]);
    }
}
