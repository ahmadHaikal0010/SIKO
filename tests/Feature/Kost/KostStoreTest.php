<?php

namespace Tests\Feature\Kost;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KostStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_kost(): void
    {
        // Buat user palsu untuk autentikasi
        $admin = User::factory()->create(['role' => 'admin']);

        // data yang akan dikirim
        $data = [
            'nama_kost' => 'Kost Mewah',
            'deskripsi' => 'Kost dengan fasilitas lengkap',
            'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'total_kamar' => '10',
            'harga_kost' => '1500000',
            'kategori' => 'putra',
        ];

        // Lakukan permintaan POST ke endpoint sambil berakting sebagai user yang diautentikasi
        $response = $this->actingAs($admin)->post(route('admin.kost.store'), $data);

        // Verifikasi bahwa data tersimpan di database
        $this->assertDatabaseHas('kosts', $data);

        // Verifikasi respons HTTP (misalnya, redirect ke halaman index atau show, atau status 201)
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.kost.index'));

        // [Opsional] Verifikasi jumlah data di tabel
        $this->assertDatabaseCount('kosts', 1);
    }
}
