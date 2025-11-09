<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'image_path',
    ];

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}
