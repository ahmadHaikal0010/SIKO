<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'nama_penghuni',
        'telpon',
        'jenis_kelamin',
        'pekerjaan',
        'nama_wali',
        'telpon_wali',
        'tanggal_masuk',
        'tanggal_keluar',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
