<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'Transaksi_id', 'id');
    }
    public function Obat()
    {
        return $this->belongsTo(DataObat::class, 'data_obat_id', 'id');
    }
}
