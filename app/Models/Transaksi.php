<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];
    const STATUS_TRUE = 'Masuk';
    const STATUS_FALSE = 'Keluar';
    public function DetailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'id');
    }
    public function getStatusBadgeAttribute()
    {
        $badges = [
            $this::STATUS_TRUE => 'success',
            $this::STATUS_FALSE => 'primary',
        ];

        return $badges[$this->status];
    }
    public function getTotalPriceAttribute()
    {
        // Menggunakan withSum untuk menghitung total_price dari relasi DetailTransaksi
        return $this->detailTransaksi->sum('total_price');
    }
}
