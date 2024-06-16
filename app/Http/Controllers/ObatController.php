<?php

namespace App\Http\Controllers;

use App\Models\DataObat;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    public function cetak_pdf($id)
    {

        $transaksi = Transaksi::where('invoice', $id)->first();
        if ($transaksi == null) {
            abort(404);
        }
        $detail = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
        if ($transaksi->status == 'Keluar') {
            $pdf = PDF::loadview('pdf.transaksiKeluar', ['transaksi' => $transaksi, 'detail' => $detail]);
        } else {
            $pdf = PDF::loadview('pdf.transaksiMasuk', ['transaksi' => $transaksi, 'detail' => $detail]);
        }

        return $pdf->stream('laporan-invoice.pdf');
    }
    public function laporanpdf(Request $request)
    {
        if ($request->status) {
            $data = Transaksi::latest()->where(function ($query) use ($request) {
                $query->where('status', $request->status); // Updated to use renamed property 'status'
                $query->whereBetween('tanggal', [$request->startDate, $request->endDate]);
            })->get();
            $status = $request->status;
            // Calculate sum total price
            $sumTotalPrice = $data->sum('total_price');

            $pdf = PDF::loadview('pdf.laporan', ['data' => $data, 'status' => $status, 'sumTotalPrice' => $sumTotalPrice]);

            return $pdf->stream('laporan.pdf');
        }
        // dd($request);
        $data = Transaksi::latest()
            ->where('status', $request->statust) // Filter berdasarkan status
            ->whereYear('tanggal', '=', intval($request->tahun)) // Filter berdasarkan tahun (misalnya 2024)
            ->whereMonth('tanggal', '=', intval($request->bulan))    // Filter berdasarkan bulan (misalnya Februari)
            ->get();
        $statust = $request->statust;
        $tahun = $request->tahun;
        $namabulan = $request->namabulan;
        $status = $statust . " Tahun: " . $tahun . " Bulan: " . $namabulan;
        // Calculate sum total price
        $sumTotalPrice = $data->sum('total_price');

        $pdf = PDF::loadview('pdf.laporan', ['data' => $data, 'status' => $status, 'sumTotalPrice' => $sumTotalPrice]);

        return $pdf->stream('laporan.pdf');
    }
    public function fetch(Request $request)
    {
        $query = $request->input('q');
        $dataobat = DataObat::take(5)->where('nama_obat', 'like', '%' . $query . '%')->get();
        $responseData = $dataobat->map(function ($obat) {
            return [
                'id' => $obat->id,
                'kode' => $obat->kode,
                'nama_obat' => $obat->nama_obat,
            ];
        });
        return response()->json($responseData);
    }
    public function keluarChartData()
    {
        $data = Transaksi::where('status', 'Keluar')
            ->whereDate('tanggal', '>', now()->subDays(30))
            ->orderBy('tanggal')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->tanggal)->format('Y-m-d');
            })
            ->map(function ($item, $key) {
                return $item->sum('total_price');
            });

        return response()->json($data);
    }
    public function topSellingDrugs()
    {
        $topDrugs = DataObat::select('data_obats.id', 'data_obats.kode', 'data_obats.nama_obat', DB::raw('SUM(detail_transaksis.quantity) as total_quantity'))
            ->join('detail_transaksis', 'data_obats.id', '=', 'detail_transaksis.data_obat_id')
            ->groupBy('data_obats.id', 'data_obats.kode', 'data_obats.nama_obat')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return response()->json($topDrugs);
    }
}
