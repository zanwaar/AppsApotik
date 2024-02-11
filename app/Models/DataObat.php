<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataObat extends Model
{
    use HasFactory;
    protected $guarded = [];
 
    public function getStatusAttribute()
    
    {

        $expiredDate = Carbon::parse($this->expired);
        $now = Carbon::now();

        if ($now->gt($expiredDate)) {
            return [
                'status' => 'Kedaluwarsa',
                'badge' => '<div class="badge badge-danger">Kedaluwarsa</div>'
            ];
        } elseif ($now->diffInDays($expiredDate->addDay()) <= 30) {
            return [
                'status' => 'Kedaluwarsa dalam ' . $now->diffInDays($expiredDate) . ' hari Lagi',
                'badge' => '<div class="badge badge-warning">Kedaluwarsa dalam ' . $now->diffInDays($expiredDate) . ' hari Lagi</div>'
            ];
        } else {
            return [
                'status' => 'Aktif',
                'badge' => '<div class="badge badge-success">Aktif</div>'
            ];
        }
    }
}
