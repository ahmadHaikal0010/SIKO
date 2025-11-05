<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kost',
        'deskripsi',
        'fasilitas',
        'alamat',
        'total_kamar',
        'harga_kost',
        'kategori',
    ];
}
