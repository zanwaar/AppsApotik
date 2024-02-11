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

        return $pdf->stream('laporan-pegawai.pdf');
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
