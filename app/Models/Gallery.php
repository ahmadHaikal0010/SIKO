<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'title',
        'image',
        'image_path',
        'media_path',
    ];

    // supaya $gallery->toArray() dan API otomatis mengembalikan image_url
    protected $appends = ['image_url'];

    /**
     * Relasi ke Kost
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }

    /**
     * URL siap pakai untuk <img src="{{ $gallery->image_url }}">
     */
    public function getImageUrlAttribute(): string
    {
        $raw = $this->image ?? $this->image_path ?? $this->media_path ?? '';

        if ($raw === '') {
            return $this->placeholder();
        }

        if (filter_var($raw, FILTER_VALIDATE_URL)) {
            return $raw;
        }

        $p = str_replace('\\', '/', $raw);
        $p = preg_replace('#^public/#', '', $p);
        $p = ltrim($p, '/');

        // Jika format "storage/..."
        if (Str::startsWith($p, 'storage/')) {
            return asset($p);
        }

        // Cek file ada
        if (Storage::disk('public')->exists($p)) {
            return asset('storage/' . $p);   // ✅ solusi aman
        }

        return $this->placeholder();
    }

    private function placeholder(): string
    {
        return 'data:image/svg+xml;utf8,' . rawurlencode(
            '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="600"><rect width="100%" height="100%" fill="#D9D9D9"/></svg>'
        );
    }
}
