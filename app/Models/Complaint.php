<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'judul_keluhan',
        'isi_keluhan',
        'tanggal_ajukan',
        'status',
        'tanggapan',
        'tanggal_tanggapan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
