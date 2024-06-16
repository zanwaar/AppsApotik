<?php

namespace App\Livewire;

use App\Models\DataObat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Grafik extends Component
{
    public $period = 'month';
    public function getTopProperty() // Menambahkan parameter $period dengan nilai default 'month'
    {
        $query = DataObat::select('data_obats.id', 'data_obats.kode', 'data_obats.nama_obat', DB::raw('SUM(detail_transaksis.quantity) as total_quantity'))
            ->join('detail_transaksis', 'data_obats.id', '=', 'detail_transaksis.data_obat_id')
            ->groupBy('data_obats.id', 'data_obats.kode', 'data_obats.nama_obat');

        // Filter berdasarkan periode waktu
        if ($this->period == 'today') {
            $query->whereDate('detail_transaksis.created_at', now());
        } elseif ($this->period == 'week') {
            $query->whereBetween('detail_transaksis.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->period == 'month') {
            $query->whereYear('detail_transaksis.created_at', now()->year)
                ->whereMonth('detail_transaksis.created_at', now()->month);
        } elseif ($this->period == 'year') {
            $query->whereYear('detail_transaksis.created_at', now()->year);
        }

        return $query->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
    }
    public function topSellingDrugs($status)
    {
        $this->period = $status;
        if ($this->period == 'today') {
            $this->period = 'today';
        } elseif ($this->period == 'week') {
            $this->period = 'week';
        } elseif ($this->period == 'month') {
            $this->period = 'month';
        } elseif ($this->period == 'year') {
            $this->period = 'year';
        }
    }
    public function render()
    {

        // dd($this->top);
        return view('livewire.grafik', ['top' => $this->top]);
    }
}
