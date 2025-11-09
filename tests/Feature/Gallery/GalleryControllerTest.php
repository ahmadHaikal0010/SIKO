<?php

namespace Tests\Feature\Gallery;

use App\Models\Gallery;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryControllerTest extends TestCase
{
    // Menggunakan RefreshDatabase untuk memastikan database bersih di setiap test
    use RefreshDatabase;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Autentikasi pengguna sebagai admin atau pengguna yang memiliki akses
        $this->user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->user);

        // Memalsukan sistem penyimpanan (Storage) agar file tidak benar-benar tersimpan
        Storage::fake('public');
    }

    // --- READ OPERATIONS ---

    // public function test_displays_the_gallery_index_page()
    // {
    //     // Siapkan data
    //     $kost = Kost::factory()->create();
    //     Gallery::factory()->count(3)->create(['kost_id' => $kost->id]);

    //     $response = $this->get(route('admin.gallery.index'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.gallery.index');
    //     $response->assertViewHas('galleries');
    //     $this->assertCount(3, $response->viewData('galleries'));
    // }

    // public function test_displays_the_gallery_create_page()
    // {
    //     $response = $this->get(route('admin.gallery.create'));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.gallery.create');
    //     // Asumsi 'kost' dilewatkan ke view, meskipun nilainya mungkin null jika getKost() return null
    //     $response->assertViewHas('kost');
    // }

    // public function test_displays_the_gallery_show_page()
    // {
    //     $kost = Kost::factory()->create();
    //     $gallery = Gallery::factory()->create(['kost_id' => $kost->id]);

    //     $response = $this->get(route('admin.gallery.show', $gallery));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.gallery.show');
    //     $response->assertViewHas('gallery');
    //     // Memastikan relasi 'kost' dimuat (eager loaded)
    //     $this->assertTrue($response->viewData('gallery')->relationLoaded('kost'));
    // }

    // public function test_displays_the_gallery_edit_page()
    // {
    //     $kost = Kost::factory()->create();
    //     $gallery = Gallery::factory()->create(['kost_id' => $kost->id]);

    //     $response = $this->get(route('admin.gallery.edit', $gallery));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.gallery.edit');
    //     $response->assertViewHas(['gallery', 'kost']);
    //     // Memastikan relasi 'kost' dimuat
    //     $this->assertTrue($response->viewData('gallery')->relationLoaded('kost'));
    // }


    // --- CREATE OPERATION ---

    public function test_can_store_multiple_galleries()
    {
        // 1. Siapkan data dan file palsu
        $kost = Kost::factory()->create();
        $image1 = UploadedFile::fake()->image('gallery1.jpg');
        $image2 = UploadedFile::fake()->image('gallery2.png');

        $data = [
            'kost_id' => $kost->id,
            // 'caption' => 'Galeri Baru', // Kalo StoreGalleryRequest punya field caption
            'images' => [$image1, $image2],
        ];

        // 2. Lakukan POST request
        $response = $this->post(route('admin.gallery.store'), $data);

        // 3. Verifikasi
        $response->assertStatus(302); // Redirect
        $response->assertRedirect(route('admin.gallery.index'));
        $response->assertSessionHas('success');

        // Verifikasi data tersimpan di database
        $this->assertCount(2, Gallery::all());

        // Verifikasi file tersimpan di storage palsu
        Storage::disk('public')->assertExists('galleries/' . $image1->hashName());
        Storage::disk('public')->assertExists('galleries/' . $image2->hashName());

        // Verifikasi image_path tersimpan di model
        $this->assertDatabaseHas('galleries', [
            'kost_id' => $kost->id,
            'image_path' => 'galleries/' . $image1->hashName(),
        ]);
        $this->assertDatabaseHas('galleries', [
            'kost_id' => $kost->id,
            'image_path' => 'galleries/' . $image2->hashName(),
        ]);
    }

    public function test_returns_validation_errors_when_storing_galleries_without_files()
    {
        $kost = Kost::factory()->create();

        $data = [
            'kost_id' => $kost->id,
            'images' => null, // Gagal karena 'required'
        ];

        $response = $this->post(route('admin.gallery.store'), $data);

        $response->assertSessionHasErrors(['images']);
        $this->assertCount(0, Gallery::all());
    }

    // --- UPDATE OPERATION ---

    public function test_can_update_a_gallery_image_and_data()
    {
        // 1. Siapkan data awal dan file lama
        $kost = Kost::factory()->create();
        $gallery = Gallery::factory()->create([
            'kost_id' => $kost->id,
            'image_path' => 'galleries/old.jpg',
        ]);

        // Buat file baru
        $newImage = UploadedFile::fake()->image('new.jpg');

        // UpdateKostRequest digunakan, tapi kita asumsikan namanya salah dan harusnya UpdateGalleryRequest
        // Kita gunakan validasi minimal
        $data = [
            'kost_id' => $kost->id,
            'image' => $newImage, // Asumsi hanya 1 file untuk update
        ];

        // 2. Lakukan PUT request
        $response = $this->put(route('admin.gallery.update', $gallery), $data);

        // 3. Verifikasi
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.gallery.index'));
        $response->assertSessionHas('success');

        // Verifikasi data di database
        $gallery->refresh();
        $this->assertEquals('galleries/' . $newImage->hashName(), $gallery->image_path);

        // Verifikasi file baru tersimpan dan file lama Dihapus (asumsi logika Service menghapus file lama)
        Storage::disk('public')->assertExists('galleries/' . $newImage->hashName());
        Storage::disk('public')->assertMissing('galleries/old.jpg'); // Uji penghapusan (jika ada di Service)
    }

    // --- DELETE OPERATION ---

    public function test_can_delete_a_gallery()
    {
        // 1. Siapkan data
        $kost = Kost::factory()->create();
        $gallery = Gallery::factory()->create([
            'kost_id' => $kost->id,
            'image_path' => 'galleries/to_delete.jpg',
        ]);

        // Simulasikan file tersimpan di storage
        Storage::disk('public')->put('galleries/to_delete.jpg', 'dummy content');

        // 2. Lakukan DELETE request
        $response = $this->delete(route('admin.gallery.destroy', $gallery));

        // 3. Verifikasi
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.gallery.index'));
        $response->assertSessionHas('success');

        // Verifikasi data hilang dari database
        $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
        $this->assertCount(0, Gallery::all());

        // Verifikasi file dihapus dari storage (asumsi logika Service menghapus file)
        Storage::disk('public')->assertMissing('galleries/to_delete.jpg');
    }
}
