<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kost;

class KostPublicController extends Controller
{
    public function show(Kost $kost)
    {
        $kost->load([
            'galleries' => fn($q) => $q->latest('id'),
            'rooms'     => fn($q) => $q->latest('id'), // opsional tampilkan daftar kamar
        ]);
        return view('public.kost.show', compact('kost'));
    }
}
