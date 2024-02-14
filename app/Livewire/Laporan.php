<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Laporan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filter = false;
    public $filtert = false;
    public $transaksi;
    public $startDate;
    public $endDate;
    public $status; // Renamed from 'type' to 'status'
    public $statust; // Renamed from 'type' to 'status'
    public $tahun; // Renamed from 'type' to 'status'
    public $bulan; // Renamed from 'type' to 'status'
    public $namabulan; // Renamed from 'type' to 'status'
    public $statusbg;

    public function fbulan($bulan)
    {
        switch ($bulan) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
            default:
                return "Bulan tidak valid";
                break;
        }
    }

    public function filtertahun()
    {
        $this->status = '';
        $this->startDate = '';
        $this->endDate = '';
        Validator::make(
            [
                'statust' => $this->statust, // Updated to use renamed property 'status'
                'tahun' => $this->tahun,
                'bulan' => $this->bulan
            ],
            [
                'statust' => 'required', // Updated to use renamed property 'status'
                'tahun' => 'required',
                'bulan' => 'required',
            ],
            [
                'statust.required' => 'Status field is required',
            ]
        )->validate();
        // dd(intval($this->bulan));

        $data = Transaksi::latest()
            ->where('status', $this->statust) // Filter berdasarkan status
            ->whereYear('tanggal', '=', intval($this->tahun)) // Filter berdasarkan tahun (misalnya 2024)
            ->whereMonth('tanggal', '=', intval($this->bulan))    // Filter berdasarkan bulan (misalnya Februari)
            ->get();
        if ($data->count() == 0) {
            $this->transaksi = null;
            return $this->dispatch('allert', ['message' =>
            'Data Tidak Di Temukan', 'title' => 'Data Tidak Ada', 'icon' => 'warning']);
        }

        $this->namabulan = $this->fbulan(intval($this->bulan));
        $this->filtert = true;
        $this->filter = true;
        $this->transaksi = $data;
    }
    public function filtertanggal()
    {
        $this->statust = '';
        $this->tahun = '';
        $this->bulan = '';

        Validator::make(
            [
                'status' => $this->status, // Updated to use renamed property 'status'
                'startDate' => $this->startDate,
                'endDate' => $this->endDate
            ],
            [
                'status' => 'required', // Updated to use renamed property 'status'
                'startDate' => 'required',
                'endDate' => 'required',
            ]
        )->validate();

        $this->filtert = false;
        $this->filter = false;
        if ($this->startDate > $this->endDate) {
            return $this->dispatch('allert', ['message' =>
            'Maaf Tanggal Awal Tidak Boleh Lebih Dari Tanggal Akhir', 'title' => 'Format Tanggal Salah', 'icon' => 'error']);
        }
        $this->endDate =  Carbon::parse($this->endDate)->addDays(1)->toDateString();
        $data = Transaksi::latest()->where(function ($query) {
            $query->where('status', $this->status); // Updated to use renamed property 'status'
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        });
        if ($data->count() == 0) {
            $this->transaksi = null;
            $this->dispatch('allert', ['message' =>
            'Data Tidak Di Temukan', 'title' => 'Data Tidak Ada', 'icon' => 'warning']);
        } else {
            $this->filter = true;
            if ($this->status == 'Masuk') { // Updated to use renamed property 'status'
                $this->statusbg = 'success';
            } else {
                $this->statusbg = 'primary';
            }
            $this->transaksi = $data->get();
        }
    }

    public function render()
    {
        return view('livewire.laporan');
    }
}
