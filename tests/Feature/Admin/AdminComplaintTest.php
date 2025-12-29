<?php

/**
 * @property \App\Models\User $admin
 * @property \App\Models\User $user
 * @mixin \Tests\TestCase
 */

/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection PhpUndefinedMethodInspection */

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);



it('shows complaint index to admin', function () {
    /** @var \Tests\TestCase $this */
    /** @var \App\Models\User $admin */ $admin = User::factory()->create(['role' => 'admin']);
    /** @var \App\Models\User $user */ $user = User::factory()->create(['role' => 'penghuni']);

    Complaint::factory()->create(['user_id' => $user->id, 'judul_keluhan' => 'Test', 'isi_keluhan' => 'Lorem']);

    $this->actingAs($admin)
        ->get(route('admin.complaint.index'))
        ->assertOk()
        ->assertSee('Kelola Keluhan')
        ->assertSee('Test');
});

it('shows complaint details and allows response by admin', function () {
    /** @var \Tests\TestCase $this */
    /** @var \App\Models\User $admin */ $admin = User::factory()->create(['role' => 'admin']);
    /** @var \App\Models\User $user */ $user = User::factory()->create(['role' => 'penghuni']);

    $c = Complaint::factory()->create(['user_id' => $user->id, 'judul_keluhan' => 'Test', 'isi_keluhan' => 'Lorem']);

    $this->actingAs($admin)
        ->get(route('admin.complaint.show', $c->id))
        ->assertOk()
        ->assertSee('Detail Keluhan')
        ->assertSee('Lorem');

    $this->actingAs($admin)
        ->put(route('admin.complaint.response', $c->id), [
            '_token' => csrf_token(),
            'user_id' => $user->id,
            'judul_keluhan' => $c->judul_keluhan,
            'isi_keluhan' => $c->isi_keluhan,
            'tanggal_ajukan' => $c->tanggal_ajukan ?? $c->created_at->toDateString(),
            'status' => 'ditanggapi',
            'tanggapan' => 'Sudah ditanggapi',
            'tanggal_tanggapan' => now()->toDateString(),
        ])
        ->assertRedirect(route('admin.complaint.index'));

    $this->assertDatabaseHas('complaints', ['id' => $c->id, 'status' => 'ditanggapi', 'tanggapan' => 'Sudah ditanggapi']);
});

it('allows admin to delete complaint', function () {
    /** @var \Tests\TestCase $this */
    /** @var \App\Models\User $admin */ $admin = User::factory()->create(['role' => 'admin']);
    /** @var \App\Models\User $user */ $user = User::factory()->create(['role' => 'penghuni']);

    $c = Complaint::factory()->create(['user_id' => $user->id]);

    // visit index first to initialize session and CSRF token
    $this->actingAs($admin)
        ->get(route('admin.complaint.index'));

    $this->actingAs($admin)
        ->post(route('admin.complaint.destroy', $c->id), ['_method' => 'DELETE', '_token' => session('_token')])
        ->assertRedirect(route('admin.complaint.index'));

    $this->assertDatabaseMissing('complaints', ['id' => $c->id]);
});
