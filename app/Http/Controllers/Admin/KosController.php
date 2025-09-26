<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function show($id)
    {
        // Ambil data kos dari database sesuai $id (nanti bisa pakai model)
        // Contoh dummy:
        $dataKos = [
            1 => [
                'nama' => 'Kos Mawar Indah',
                'alamat' => 'Jl. Melati No. 10, Dekat Kampus A',
                'fasilitas' => 'WiFi, AC, Kamar Mandi Dalam, Parkir',
                'harga' => 'Rp 800.000/bulan'
            ],
            2 => [
                'nama' => 'Kos Anggrek Asri',
                'alamat' => 'Jl. Kenanga No. 5, Dekat Kampus B',
                'fasilitas' => 'WiFi, Kipas Angin, Dapur Bersama',
                'harga' => 'Rp 650.000/bulan'
            ],
            3 => [
                'nama' => 'Kos Melati Putih',
                'alamat' => 'Jl. Dahlia No. 12, Dekat Pusat Kota',
                'fasilitas' => 'WiFi, AC, Laundry, Keamanan 24 Jam',
                'harga' => 'Rp 1.000.000/bulan'
            ],
        ];

        $kos = $dataKos[$id] ?? null;
        if (!$kos) {
            abort(404);
        }

        return view('admin.kos.show', compact('kos'));
    }
}
