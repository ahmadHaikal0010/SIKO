<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kost;

class KostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kost::create([
            'nama_kost' => 'Kos Hj. Nasrul',
            'alamat' => 'Jl. Mawar No. 12, Padang',
            'harga_kost' => 14000000,
            'deskripsi' => 'Kost eksklusif dekat Unand',
            'fasilitas' => 'WiFi, Dapur, Parkir',
            'total_kamar' => 20,
            'kategori' => 'Putra/Putri',
        ]);

        Kost::create([
            'nama_kost' => 'Kos Sakura',
            'alamat' => 'Jl. Kenanga No. 3, Padang',
            'harga_kost' => 12000000,
            'deskripsi' => 'Lingkungan tenang',
            'fasilitas' => 'WiFi, Laundry',
            'total_kamar' => 15,
            'kategori' => 'Putri',
        ]);

        Kost::create([
            'nama_kost' => 'Kos Mentari',
            'alamat' => 'Jl. Melati No. 8, Padang',
            'harga_kost' => 10000000,
            'deskripsi' => 'Akses mudah transportasi',
            'fasilitas' => 'WiFi, Air Panas',
            'total_kamar' => 12,
            'kategori' => 'Putra',
        ]);
    }
}
