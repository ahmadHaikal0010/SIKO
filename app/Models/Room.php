<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'nomor_kamar',
        'status',
    ];

    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
