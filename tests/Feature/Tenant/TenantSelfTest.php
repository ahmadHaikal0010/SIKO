<?php

/**
 * @mixin \Tests\TestCase
 */

/** @noinspection PhpUndefinedMethodInspection */

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('prevents pending penghuni from accessing dashboard', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create(['role' => 'penghuni', 'is_accepted' => 'pending']);

    $this->actingAs($user)
        ->get(route('tenant.dashboard'))
        ->assertOk()
        ->assertSee('Akun Anda sedang menunggu persetujuan');
});

it('prevents pending penghuni from accessing tenant create page', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create(['role' => 'penghuni', 'is_accepted' => 'pending']);

    $this->actingAs($user)
        ->get(route('tenant.tenant.create'))
        ->assertOk()
        ->assertSee('Akun Anda sedang menunggu persetujuan');
});

it('shows notification on dashboard for accepted penghuni without tenant and allows access to create form', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create(['role' => 'penghuni', 'is_accepted' => 'accepted']);

    $this->actingAs($user)
        ->get(route('tenant.dashboard'))
        ->assertOk()
        ->assertSee('Silakan lengkapi data penghuni Anda terlebih dahulu')
        ->assertSee('Lengkapi Data Penghuni');

    $this->actingAs($user)
        ->get(route('tenant.tenant.create'))
        ->assertOk()
        ->assertSee('Lengkapi Data Penghuni');
});
