<?php

/**
 * @mixin \Tests\TestCase
 */

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

uses(RefreshDatabase::class);

it('allows tenant to upload attachment and admin can view it', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'penghuni', 'is_accepted' => 'accepted']);
    $file = UploadedFile::fake()->image('photo.jpg');

    /** @var \Tests\TestCase $this */
    $this->actingAs($user)
        ->post(route('tenant.complaint.store'), [
            'user_id' => $user->id,
            'judul_keluhan' => 'Ada masalah',
            'isi_keluhan' => 'Rincian masalah',
            'tanggal_ajukan' => now()->toDateString(),
            'status' => 'menunggu',
            'attachment' => $file,
        ])
        ->assertRedirect(route('tenant.complaint.index'));

    $complaint = Complaint::firstOrFail();

    // file saved
    /** @var FilesystemAdapter $disk */
    $disk = Storage::disk('public');
    $disk->assertExists($complaint->attachment);

    // admin can view link
    $admin = User::factory()->create(['role' => 'admin']);

    /** @var \Tests\TestCase $this */
    $this->actingAs($admin)
        ->get(route('admin.complaint.show', $complaint->id))
        ->assertOk()
        ->assertSee('Lihat Lampiran');
});
