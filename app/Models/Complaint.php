<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_keluhan',
        'isi_keluhan',
        'tanggal_ajukan',
        'status',
        'tanggapan',
        'tanggal_tanggapan',
        'attachment',
    ];

    public function getAttachmentUrlAttribute(): ?string
    {
        if (!$this->attachment) {
            return null;
        }

        return Storage::url($this->attachment);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
