<?php

namespace Tests\Feature\Tenant;

use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantTest extends TestCase
{
    use RefreshDatabase;

    // public function test_admin_can_view_tenant_index()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Login sebagai admin dan akses halaman index tenant
    //     $response = $this->actingAs($admin)->get(route('admin.tenant.index'));

    //     // 3. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.tenant.index');
    // }

    // public function test_admin_can_view_tenant_create_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Login sebagai admin dan akses halaman create tenant
    //     $response = $this->actingAs($admin)->get(route('admin.tenant.create'));

    //     // 3. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.tenant.create');
    // }

    // public function test_admin_can_view_tenant_show_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Buat Kost karena Tenant butuh kost_id dan room_id
    //     $kost = Kost::factory()->create();
    //     $room = Room::factory()->create([
    //         'kost_id' => $kost->id,
    //     ]);

    //     // 3. Buat data tenant untuk ditampilkan
    //     $tenant = Tenant::factory()->create([
    //         'user_id' => $admin->id,
    //         'room_id' => $room->id,
    //         'nama_penghuni' => 'John Doe',
    //         'telpon' => '08123456789',
    //         'jenis_kelamin' => 'laki-laki',
    //         'pekerjaan' => 'karyawan',
    //         'nama_wali' => 'Jane Doe',
    //         'telpon_wali' => '08987654321',
    //         'tanggal_masuk' => '2024-01-01',
    //         'tanggal_keluar' => null,
    //         'status' => 'active',
    //     ]);

    //     // 4. Login sebagai admin dan akses halaman show tenant
    //     $response = $this->actingAs($admin)->get(route('admin.tenant.show', $tenant->id));

    //     // 5. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.tenant.show');
    // }

    public function test_admin_can_store_tenant()
    {
        // 1. Buat user admin sesuai middleware
        $admin = User::factory()->create([
            'role' => 'admin', // pastikan field role memang ada
        ]);

        // 2. Buat Kost karena Tenant butuh kost_id dan room_id
        $kost = Kost::factory()->create();
        $room = Room::factory()->create([
            'kost_id' => $kost->id,
        ]);

        // 3. Buat data tenant untuk ditampilkan
        $tenant = [
            'user_id' => $admin->id,
            'room_id' => $room->id,
            'nama_penghuni' => 'John Doe',
            'telpon' => '08123456789',
            'jenis_kelamin' => 'laki-laki',
            'pekerjaan' => 'karyawan',
            'nama_wali' => 'Jane Doe',
            'telpon_wali' => '08987654321',
            'tanggal_masuk' => '2024-01-01',
            'tanggal_keluar' => null,
            'status' => 'active',
        ];

        // 4. Kirim request
        $response = $this->actingAs($admin)->post(route('admin.tenant.store'), $tenant);

        // 5. Pastikan data tersimpan
        $this->assertDatabaseHas('tenants', $tenant);

        // 6. Redirect ke index
        $response->assertRedirect(route('admin.tenant.index'));
    }

    // public function test_admin_can_view_tenant_edit_page()
    // {
    //     // 1. Buat user admin sesuai middleware
    //     $admin = User::factory()->create([
    //         'role' => 'admin', // pastikan field role memang ada
    //     ]);

    //     // 2. Buat Kost karena Tenant butuh kost_id dan room_id
    //     $kost = Kost::factory()->create();
    //     $room = Room::factory()->create([
    //         'kost_id' => $kost->id,
    //     ]);

    //     // 3. Buat data tenant untuk ditampilkan
    //     $tenant = Tenant::factory()->create([
    //         'user_id' => $admin->id,
    //         'room_id' => $room->id,
    //         'nama_penghuni' => 'John Doe',
    //         'telpon' => '08123456789',
    //         'jenis_kelamin' => 'laki-laki',
    //         'pekerjaan' => 'karyawan',
    //         'nama_wali' => 'Jane Doe',
    //         'telpon_wali' => '08987654321',
    //         'tanggal_masuk' => '2024-01-01',
    //         'tanggal_keluar' => null,
    //         'status' => 'active',
    //     ]);

    //     // 4. Login sebagai admin dan akses halaman edit tenant
    //     $response = $this->actingAs($admin)->get(route('admin.tenant.edit', $tenant->id));

    //     // 5. Pastikan halaman dapat diakses
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.tenant.edit');
    // }

    public function test_admin_can_update_tenant(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $kost = Kost::factory()->create();
        $room = Room::factory()->create([
            'kost_id' => $kost->id,
        ]);

        $tenant = Tenant::factory()->create([
            'user_id' => $admin->id,
            'room_id' => $room->id,
            'nama_penghuni' => 'John Doe',
            'telpon' => '08123456789',
            'jenis_kelamin' => 'laki-laki',
            'pekerjaan' => 'karyawan',
            'nama_wali' => 'Jane Doe',
            'telpon_wali' => '08987654321',
            'tanggal_masuk' => '2024-01-01',
            'tanggal_keluar' => null,
            'status' => 'active',
        ]);

        $updatedTenantData = [
            'user_id' => $admin->id,
            'room_id' => $room->id,
            'nama_penghuni' => 'John Smith',
            'telpon' => '08129876543',
            'jenis_kelamin' => 'laki-laki',
            'pekerjaan' => 'wirausaha',
            'nama_wali' => 'Janet Smith',
            'telpon_wali' => '08981234567',
            'tanggal_masuk' => '2024-02-01',
            'tanggal_keluar' => null,
            'status' => 'active',
        ];

        $response = $this->actingAs($admin)->put(route('admin.tenant.update', $tenant->id), $updatedTenantData);

        $response->assertRedirect(route('admin.tenant.index'));

        $this->assertDatabaseHas('tenants', $updatedTenantData);

        $this->assertDatabaseMissing('tenants', [
            'nama_penghuni' => 'John Doe',
            'telpon' => '08129876543',
            'pekerjaan' => 'wirausaha',
            'nama_wali' => 'Janet Smith',
            'tanggal_masuk' => '2024-02-01',
        ]);
    }

    public function test_admin_can_delete_tenant(): void
    {
        // Buat user admin
        $admin = User::factory()->create(['role' => 'admin']);

        $kost = Kost::factory()->create();
        $room = Room::factory()->create([
            'kost_id' => $kost->id,
        ]);

        $tenant = Tenant::factory()->create([
            'user_id' => $admin->id,
            'room_id' => $room->id,
            'nama_penghuni' => 'John Doe',
            'telpon' => '08123456789',
            'jenis_kelamin' => 'laki-laki',
            'pekerjaan' => 'karyawan',
            'nama_wali' => 'Jane Doe',
            'telpon_wali' => '08987654321',
            'tanggal_masuk' => '2024-01-01',
            'tanggal_keluar' => null,
            'status' => 'active',
        ]);

        // Lakukan permintaan DELETE
        $response = $this->actingAs($admin)->delete(route('admin.tenant.destroy', $tenant->id));

        // Pastikan data terhapus
        $this->assertDatabaseMissing('tenants', ['id' => $tenant->id]);

        // Pastikan response redirect (biasanya ke index)
        $response->assertRedirect(route('admin.tenant.index'));

        // Pastikan jumlah data = 0
        $this->assertDatabaseCount('tenants', 0);
    }
}
