<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kost','deskripsi','fasilitas','alamat',
        'total_kamar','harga_kost','kategori',
    ];

    public function rooms(): HasMany
    {
        // Bro memang pakai 'kosts_id'
        return $this->hasMany(Room::class, 'kost_id');
    }

    public function galleries(): HasMany
    {
        // FK default 'kost_id' sdh sesuai
        return $this->hasMany(Gallery::class);
    }

    // Cover untuk kartu landing: $kost->cover_url
   public function getCoverUrlAttribute(): string
{
    $g = $this->galleries()

        ->orderByDesc('created_at')    // paling baru
        ->orderByDesc('id')            // tie-break
        ->first();

    // Manfaatkan accessor Gallery::image_url yang sudah aman
    return $g?->image_url
        ?? 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80';
}

}
