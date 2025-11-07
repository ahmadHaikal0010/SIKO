<?php

namespace Tests\Feature\Room;

use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    // public function test_admin_can_view_room_index()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Login sebagai admin dan akses halaman index room
    //     $response = $this->actingAs($admin)->get(route('admin.room.index'));

    //     // 3. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.room.index');
    // }

    // public function test_admin_can_view_room_create_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Login sebagai admin dan akses halaman create room
    //     $response = $this->actingAs($admin)->get(route('admin.room.create'));

    //     // 3. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.room.create');
    // }

    // public function test_admin_can_view_room_show_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Buat Kost karena Room butuh kost_id
    //     $kost = Kost::factory()->create();

    //     // 3. Buat data room untuk ditampilkan
    //     $room = Room::factory()->create([
    //         'kost_id' => $kost->id,
    //         'nomor_kamar' => 'A17',
    //         'status' => 'available',
    //     ]);

    //     // 4. Login sebagai admin dan akses halaman show room
    //     $response = $this->actingAs($admin)->get(route('admin.room.show', $room->id));

    //     // 5. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.room.show');
    // }

    public function test_admin_can_store_room()
    {
        // 1. Buat user admin sesuai middleware
        $admin = User::factory()->create([
            'role' => 'admin', // pastikan field role memang ada
        ]);

        // 2. Login sebagai admin
        // $this->actingAs($admin);

        // 3. Buat Kost karena Room butuh kost_id
        $kost = Kost::factory()->create();

        // 4. Data room
        $roomData = [
            'kost_id' => $kost->id,
            'nomor_kamar' => 'A17',
            'status' => 'available',
        ];

        // 5. Kirim request
        $response = $this->actingAs($admin)->post(route('admin.room.store'), $roomData);

        // Debug
        // $response->dump();

        // 6. Pastikan data tersimpan
        $this->assertDatabaseHas('rooms', $roomData);

        // 7. Redirect ke index
        $response->assertRedirect(route('admin.room.index'));
    }

    // public function test_admin_can_view_room_edit_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Buat Kost karena Room butuh kost_id
    //     $kost = Kost::factory()->create();

    //     // 3. Buat data room untuk diedit
    //     $room = Room::factory()->create([
    //         'kost_id' => $kost->id,
    //         'nomor_kamar' => 'A17',
    //         'status' => 'available',
    //     ]);

    //     // 4. Login sebagai admin dan akses halaman edit room
    //     $response = $this->actingAs($admin)->get(route('admin.room.edit', $room->id));

    //     // 5. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.room.edit');
    // }

    public function test_admin_can_update_room(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $kost = Kost::factory()->create();

        $roomData = Room::factory()->create([
            'kost_id' => $kost->id,
            'nomor_kamar' => 'A17',
            'status' => 'available',
        ]);

        $updatedRoomData = [
            'kost_id' => $kost->id,
            'nomor_kamar' => 'A20',
            'status' => 'occupied',
        ];

        $response = $this->actingAs($admin)->put(route('admin.room.update', $roomData->id), $updatedRoomData);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.room.index'));

        $this->assertDatabaseHas('rooms', $updatedRoomData);

        $this->assertDatabaseMissing('rooms', [
            'nomor_kamar' => 'A17',
            'status' => 'available',
        ]);
    }

    public function test_admin_can_delete_kost(): void
    {
        // Buat user admin
        $admin = User::factory()->create(['role' => 'admin']);

        $kost = Kost::factory()->create();

        $roomData = Room::factory()->create([
            'kost_id' => $kost->id,
            'nomor_kamar' => 'A17',
            'status' => 'available',
        ]);

        // Lakukan permintaan DELETE
        $response = $this->actingAs($admin)->delete(route('admin.room.destroy', $roomData->id));

        // Pastikan data terhapus
        $this->assertDatabaseMissing('rooms', ['id' => $roomData->id]);

        // Pastikan response redirect (biasanya ke index)
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.room.index'));

        // Pastikan jumlah data = 0
        $this->assertDatabaseCount('rooms', 0);
    }
}
