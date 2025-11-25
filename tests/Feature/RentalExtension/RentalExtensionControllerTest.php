<?php

namespace Tests\Feature\RentalExtension;

use App\Models\RentalExtension;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RentalExtensionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    // public function test_admin_can_view_index()
    // {
    //     RentalExtension::factory()->count(3)->create();

    //     $response = $this->actingAs($this->admin)->get(route('admin.rental_extension.index'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.rental_extension.index');
    //     $response->assertViewHas('rentalExtensions');
    // }

    // public function test_admin_can_view_show()
    // {
    //     $r = RentalExtension::factory()->create();

    //     $response = $this->actingAs($this->admin)->get(route('admin.rental_extension.show', $r));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.rental_extension.show');
    //     $response->assertViewHas('rentalExtension');
    // }

    public function test_admin_can_accept_rental_extension()
    {
        $r = RentalExtension::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($this->admin)->post(route('admin.rental_extension.accept', $r));

        $response->assertRedirect(route('admin.rental_extension.index'));
        $this->assertDatabaseHas('rental_extensions', ['id' => $r->id, 'status' => 'approved']);
    }

    public function test_admin_can_reject_rental_extension()
    {
        $r = RentalExtension::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($this->admin)->post(route('admin.rental_extension.reject', $r));

        $response->assertRedirect(route('admin.rental_extension.index'));
        $this->assertDatabaseHas('rental_extensions', ['id' => $r->id, 'status' => 'rejected']);
    }

    public function test_admin_can_delete_rental_extension()
    {
        $r = RentalExtension::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.rental_extension.destroy', $r));

        $response->assertRedirect(route('admin.rental_extension.index'));
        $this->assertDatabaseMissing('rental_extensions', ['id' => $r->id]);
    }
}
