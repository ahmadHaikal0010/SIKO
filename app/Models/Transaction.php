<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'jumlah_bayar',
        'tanggal_bayar',
        'periode_mulai',
        'periode_selesai',
        'metode_pembayaran',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
