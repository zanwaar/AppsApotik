<?php

namespace App\Http\Controllers;

use App\Models\DataObat;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use PDF;
use Illuminate\Http\Request;

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
}
