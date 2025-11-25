<?php

namespace Tests\Feature\TenantRentalExtension;

use App\Models\RentalExtension;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantRentalExtensionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Tenant $tenant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'penghuni']);
        $this->tenant = Tenant::factory()->create(['user_id' => $this->user->id]);
    }

    // public function test_tenant_can_view_index()
    // {
    //     RentalExtension::factory()->count(2)->create(['tenant_id' => $this->tenant->id]);

    //     $response = $this->actingAs($this->user)->get(route('tenant.rental_extension.index'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('tenant.rental_extension.index');
    //     $response->assertViewHas('rentalExtensions');
    // }

    public function test_tenant_can_store_rental_extension()
    {
        $data = [
            'tenant_id' => $this->tenant->id,
            'tanggal_pengajuan' => now()->format('Y-m-d'),
            'tanggal_mulai' => now()->addDays(1)->format('Y-m-d'),
            'tanggal_selesai' => now()->addDays(31)->format('Y-m-d'),
            'status' => 'pending',
        ];

        $response = $this->actingAs($this->user)->post(route('tenant.rental_extension.store'), $data);

        $response->assertRedirect(route('tenant.rental_extension.index'));
        $this->assertDatabaseHas('rental_extensions', [
            'tenant_id' => $this->tenant->id,
            'status' => 'pending',
        ]);
    }

    public function test_tenant_can_update_owned_rental_extension()
    {
        $r = RentalExtension::factory()->create(['tenant_id' => $this->tenant->id, 'status' => 'pending']);

        $data = [
            'tenant_id' => $this->tenant->id,
            'tanggal_pengajuan' => now()->format('Y-m-d'),
            'tanggal_mulai' => now()->addDays(2)->format('Y-m-d'),
            'tanggal_selesai' => now()->addDays(32)->format('Y-m-d'),
            'status' => 'pending',
        ];

        $response = $this->actingAs($this->user)->put(route('tenant.rental_extension.update', $r), $data);

        $response->assertRedirect(route('tenant.rental_extension.index'));
        $this->assertDatabaseHas('rental_extensions', ['id' => $r->id, 'tenant_id' => $this->tenant->id]);
    }

    public function test_tenant_can_delete_owned_rental_extension()
    {
        $r = RentalExtension::factory()->create(['tenant_id' => $this->tenant->id]);

        $response = $this->actingAs($this->user)->delete(route('tenant.rental_extension.destroy', $r));

        $response->assertRedirect(route('tenant.rental_extension.index'));
        $this->assertDatabaseMissing('rental_extensions', ['id' => $r->id]);
    }
}
