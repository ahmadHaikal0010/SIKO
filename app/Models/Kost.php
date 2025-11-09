<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'kosts_id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
