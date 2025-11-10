<?php

namespace App\Http\Requests\Gallery;

use App\Models\Gallery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateGalleryRequest extends FormRequest
{
    /**
     * Apakah user berhak melakukan update?
     */
    public function authorize(): bool
    {
        /** @var \App\Models\Gallery|null $gallery */
        $gallery = $this->route('gallery'); // route model binding: admin/gallery/{gallery}
        // Jika belum ada model di route (harusnya ada), fallback izinkan saja:
        return $gallery instanceof Gallery
            ? Gate::allows('update', $gallery)
            : true;
    }

    /**
     * Aturan validasi.
     * NOTE: gambar dibuat **nullable** supaya tidak wajib saat edit.
     */
    public function rules(): array
    {
        return [
            'kost_id' => ['required', 'exists:kosts,id'],
            'title'   => ['nullable', 'string', 'max:100'],
            // <- opsional saat edit
            'image'   => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
        ];
    }

    /**
     * Pesan khusus (opsional).
     */
    public function messages(): array
    {
        return [
            'kost_id.required' => 'Pilih kost.',
            'kost_id.exists'   => 'Kost tidak valid.',
            'title.max'        => 'Judul maksimal 100 karakter.',
            'image.image'      => 'File harus berupa gambar.',
            'image.max'        => 'Ukuran gambar maksimal 2MB.',
            'image.mimes'      => 'Format harus jpeg, jpg, png, atau gif.',
        ];
    }
}
