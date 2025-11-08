<?php

namespace Tests\Feature\Kost;

use App\Models\Kost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KostTest extends TestCase
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

    public function test_admin_can_delete_kost(): void
    {
        // Buat user admin
        $admin = User::factory()->create(['role' => 'admin']);

        // Buat satu data kost
        $kost = Kost::factory()->create([
            'nama_kost' => 'Kost Lama',
            'deskripsi' => 'Kost yang akan dihapus',
            'fasilitas' => 'WiFi, Kamar Mandi Dalam',
            'alamat' => 'Jl. Veteran No. 12',
            'total_kamar' => 5,
            'harga_kost' => 1000000,
            'kategori' => 'putri',
        ]);

        // Lakukan permintaan DELETE
        $response = $this->actingAs($admin)->delete(route('admin.kost.destroy', $kost->id));

        // Pastikan data terhapus
        $this->assertDatabaseMissing('kosts', ['id' => $kost->id]);

        // Pastikan response redirect (biasanya ke index)
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.kost.index'));

        // Pastikan jumlah data = 0
        $this->assertDatabaseCount('kosts', 0);
    }
}
