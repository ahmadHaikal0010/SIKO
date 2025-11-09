<?php

namespace Tests\Feature\Transaction;

use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    // public function test_admin_can_view_transaction_index()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Login sebagai admin dan akses halaman index transaction
    //     $response = $this->actingAs($admin)->get(route('admin.transaction.index'));

    //     // 3. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.transaction.index');
    // }

    // public function test_admin_can_view_transaction_create_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Login sebagai admin dan akses halaman create transaction
    //     $response = $this->actingAs($admin)->get(route('admin.transaction.create'));

    //     // 3. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.transaction.create');
    // }

    // public function test_admin_can_view_transaction_show_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Buat data karena transaction butuh kost_id, room_id, dan tenant_id
    //     $kost = Kost::factory()->create();
    //     $room = Room::factory()->create([
    //         'kost_id' => $kost->id,
    //     ]);
    //     $tenant = Tenant::factory()->create([
    //         'user_id' => $admin->id,
    //         'room_id' => $room->id,
    //     ]);

    //     // 3. Buat data transaction
    //     $transaction = Transaction::factory()->create([
    //         'tenant_id' => $tenant->id,
    //         'jumlah_bayar' => 1500000.00,
    //         'tanggal_bayar' => '2024-01-05',
    //         'periode_mulai' => '2024-01-01',
    //         'periode_selesai' => '2024-01-31',
    //         'metode_pembayaran' => 'cash',
    //     ]);

    //     // 4. Login sebagai admin dan akses halaman show transaction
    //     $response = $this->actingAs($admin)->get(route('admin.transaction.show', $transaction->id));

    //     // 5. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.transaction.show');
    // }

    public function test_admin_can_store_transaction()
    {
        // 1. Buat user admin sesuai middleware
        $admin = User::factory()->create([
            'role' => 'admin', // pastikan field role memang ada
        ]);

        // 2. Buat data karena transaction butuh kost_id, room_id, dan tenant_id
        $kost = Kost::factory()->create();
        $room = Room::factory()->create([
            'kost_id' => $kost->id,
        ]);
        $tenant = Tenant::factory()->create([
            'user_id' => $admin->id,
            'room_id' => $room->id,
        ]);

        // 3. Buat data transaction
        $transaction = [
            'tenant_id' => $tenant->id,
            'jumlah_bayar' => 1500000.00,
            'tanggal_bayar' => '2024-01-05',
            'periode_mulai' => '2024-01-01',
            'periode_selesai' => '2024-01-31',
            'metode_pembayaran' => 'cash',
        ];

        // 4. Kirim request
        $response = $this->actingAs($admin)->post(route('admin.transaction.store'), $transaction);

        // 5. Pastikan data tersimpan
        $this->assertDatabaseHas('transactions', $transaction);

        // 6. Redirect ke index
        $response->assertRedirect(route('admin.transaction.index'));
    }

    // public function test_admin_can_view_transaction_edit_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Buat data karena transaction butuh kost_id, room_id, dan tenant_id
    //     $kost = Kost::factory()->create();
    //     $room = Room::factory()->create([
    //         'kost_id' => $kost->id,
    //     ]);
    //     $tenant = Tenant::factory()->create([
    //         'user_id' => $admin->id,
    //         'room_id' => $room->id,
    //     ]);

    //     // 3. Buat data transaction
    //     $transaction = Transaction::factory()->create([
    //         'tenant_id' => $tenant->id,
    //         'jumlah_bayar' => 1500000.00,
    //         'tanggal_bayar' => '2024-01-05',
    //         'periode_mulai' => '2024-01-01',
    //         'periode_selesai' => '2024-01-31',
    //         'metode_pembayaran' => 'cash',
    //     ]);

    //     // 4. Login sebagai admin dan akses halaman edit transaction
    //     $response = $this->actingAs($admin)->get(route('admin.transaction.edit', $transaction->id));

    //     // 5. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.transaction.edit');
    // }

    public function test_admin_can_update_transaction(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $kost = Kost::factory()->create();
        $room = Room::factory()->create([
            'kost_id' => $kost->id,
        ]);
        $tenant = Tenant::factory()->create([
            'user_id' => $admin->id,
            'room_id' => $room->id,
        ]);

        $transaction = Transaction::factory()->create([
            'tenant_id' => $tenant->id,
            'jumlah_bayar' => 1500000.00,
            'tanggal_bayar' => '2024-01-05',
            'periode_mulai' => '2024-01-01',
            'periode_selesai' => '2024-01-31',
            'metode_pembayaran' => 'cash',
        ]);

        $updatedTransactionData = [
            'tenant_id' => $tenant->id,
            'jumlah_bayar' => 1200000.00,
            'tanggal_bayar' => '2023-01-05',
            'periode_mulai' => '2024-01-01',
            'periode_selesai' => '2024-01-31',
            'metode_pembayaran' => 'cash',
        ];

        $response = $this->actingAs($admin)->put(route('admin.transaction.update', $transaction->id), $updatedTransactionData);

        $response->assertRedirect(route('admin.transaction.index'));

        $this->assertDatabaseHas('transactions', $updatedTransactionData);

        $this->assertDatabaseMissing('transactions', [
            'jumlah_bayar' => 1500000.00,
            'tanggal_bayar' => '2024-01-05',
        ]);
    }

    public function test_admin_can_delete_transaction(): void
    {
        // Buat user admin
        $admin = User::factory()->create(['role' => 'admin']);

        // 2. Buat data karena transaction butuh kost_id, room_id, dan tenant_id
        $kost = Kost::factory()->create();
        $room = Room::factory()->create([
            'kost_id' => $kost->id,
        ]);
        $tenant = Tenant::factory()->create([
            'user_id' => $admin->id,
            'room_id' => $room->id,
        ]);

        // 3. Buat data transaction
        $transaction = Transaction::factory()->create([
            'tenant_id' => $tenant->id,
            'jumlah_bayar' => 1500000.00,
            'tanggal_bayar' => '2024-01-05',
            'periode_mulai' => '2024-01-01',
            'periode_selesai' => '2024-01-31',
            'metode_pembayaran' => 'cash',
        ]);

        // Lakukan permintaan DELETE
        $response = $this->actingAs($admin)->delete(route('admin.transaction.destroy', $transaction->id));

        // Pastikan data terhapus
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);

        // Pastikan response redirect (biasanya ke index)
        $response->assertRedirect(route('admin.transaction.index'));

        // Pastikan jumlah data = 0
        $this->assertDatabaseCount('transactions', 0);
    }
}
