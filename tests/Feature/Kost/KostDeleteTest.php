<?php

namespace Tests\Feature\Kost;

use App\Models\User;
use App\Models\Kost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KostDeleteTest extends TestCase
{
    use RefreshDatabase;

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
