<?php

namespace Tests\Feature\Kost;

use App\Models\User;
use App\Models\Kost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KostUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_kost(): void
    {
        // 1. Buat user admin
        $admin = User::factory()->create(['role' => 'admin']);

        // 2. Buat data Kost awal
        $kost = Kost::factory()->create([
            'nama_kost' => 'Kost Lama',
            'deskripsi' => 'Deskripsi lama',
            'fasilitas' => 'Kipas Angin',
            'alamat' => 'Jl. Lama No. 1',
            'total_kamar' => 5,
            'harga_kost' => 1000000,
            'kategori' => 'putra',
        ]);

        // 3. Data baru untuk update
        $updatedData = [
            'nama_kost' => 'Kost Mewah',
            'deskripsi' => 'Kost dengan fasilitas lengkap',
            'fasilitas' => 'AC, WiFi, Kamar Mandi Dalam',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'total_kamar' => 10,
            'harga_kost' => 1500000,
            'kategori' => 'putra',
        ];

        // 4. Kirim request PUT/PATCH ke route update
        $response = $this->actingAs($admin)->put(
            route('admin.kost.update', $kost->id),
            $updatedData
        );

        // 5. Pastikan redirect sukses (misal ke index)
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.kost.index'));

        // 6. Pastikan data di database sudah berubah
        $this->assertDatabaseHas('kosts', $updatedData);

        // 7. Pastikan data lama sudah tidak ada (opsional)
        $this->assertDatabaseMissing('kosts', [
            'nama_kost' => 'Kost Lama',
            'deskripsi' => 'Deskripsi lama',
        ]);
    }
}
