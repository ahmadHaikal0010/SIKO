<?php

namespace Tests\Feature\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Autentikasi pengguna sebagai admin atau pengguna yang memiliki akses
        $this->user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->user);
    }

    /** @test */
    // public function test_admin_can_view_account_index()
    // {
    //
    //     $response = $this->get(route('admin.account.index'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.account.index');
    // }

    // /** @test */
    // public function test_admin_can_view_create_form()
    // {
    //
    //     $response = $this->get(route('admin.account.create'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.account.create');
    // }

    /** @test */
    public function test_admin_can_store_new_account()
    {
        $data = [
            'name' => 'User Testing',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('admin.account.store'), $data);

        $response->assertRedirect(route('admin.account.index'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /** @test */
    // public function test_admin_can_show_account_detail()
    // {
    //
    //     $user = User::factory()->create(['role' => 'user']);

    //     $response = $this->get(route('admin.account.show', $user));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.account.show');
    //     $response->assertViewHas('user', $user);
    // }

    /** @test */
    // public function test_admin_can_view_edit_form()
    // {
    //
    //     $user = User::factory()->create(['role' => 'user']);

    //     $response = $this->get(route('admin.account.edit', $user));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.account.edit');
    // }

    /** @test */
    public function test_admin_can_update_account()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'email' => $user->email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->put(route('admin.account.update', $user), $data);

        $response->assertRedirect(route('admin.account.index'));

        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    /** @test */
    public function test_admin_can_delete_account()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('admin.account.destroy', $user));

        $response->assertRedirect(route('admin.account.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function test_admin_can_accept_account()
    {
        $user = User::factory()->create();

        $response = $this->post(route('admin.account.accept', $user));

        $response->assertRedirect(route('admin.account.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_accepted' => 'accepted'
        ]);
    }

    /** @test */
    public function test_admin_can_reject_account()
    {
        $user = User::factory()->create();

        $response = $this->post(route('admin.account.reject', $user));

        $response->assertRedirect(route('admin.account.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_accepted' => 'rejected'
        ]);
    }
}
