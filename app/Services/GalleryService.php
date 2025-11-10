<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\Kost;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function getAll()
    {
        return Gallery::with('kost')->latest()->paginate(10);
    }

    public function read(Gallery $gallery)
    {
        return $gallery->load('kost');
    }

    public function getKost()
    {
        return Kost::all();
    }

    public function create(array $data, array $images)
    {
        $galleryData = [];

        foreach ($images as $image) {
            if ($image->isValid()) {
                $path = $image->store('galleries', 'public');

                $galleryData[] = [
                    'kost_id'    => $data['kost_id'],
                    'image_path' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        return Gallery::insert($galleryData);
    }

    public function update(Gallery $gallery, array $data, $image = null): Gallery
    {
        // Jangan ikutkan field 'image' mentah (UploadedFile) ke update()
        unset($data['image']);

        // Jika ada file baru -> ganti file lama + set image_path baru
        if ($image && $image->isValid()) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $image->store('galleries', 'public');
        }

        // Update field lain (kost_id, title, dll)
        $gallery->update($data);

        return $gallery->fresh();
    }

    public function delete(Gallery $gallery)
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();
    }
}
