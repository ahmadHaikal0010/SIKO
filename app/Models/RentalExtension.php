<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalExtension extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'tanggal_pengajuan', 'tanggal_mulai', 'tanggal_selesai', 'status'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
