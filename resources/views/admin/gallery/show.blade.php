@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $imageUrl = function($g) {
        $path = $g->image ?? $g->media_path ?? $g->image_path ?? null;

        // Jika sudah URL absolute
        if ($path && filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Jika path sudah mengandung /storage (mis. storage symlink)
        if ($path && (Str::startsWith($path, '/storage') || Str::startsWith($path, 'storage/'))) {
            return asset(ltrim($path, '/'));
        }

        // Cek file pada disk 'public'
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        // fallback placeholder
        return 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="560" height="260"><rect width="100%" height="100%" fill="#D9D9D9"/></svg>');
    };
@endphp

@extends('layouts.admin')
@section('title','Detail Foto Galeri')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold">Detail Foto</h4>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
</div>

<div class="card border-0 shadow-sm p-4">

    <img src="{{ $imageUrl($gallery) }}" class="rounded border mb-3"
         style="width:100%; max-height:520px; object-fit:contain;">

    <h5 class="fw-semibold mb-1">
        {{ $gallery->title ?? 'Tanpa Judul' }}
    </h5>

    @isset($gallery->created_at)
        <p class="text-muted mb-0">
            Diunggah pada {{ $gallery->created_at->format('d M Y H:i') }}
        </p>
    @endisset

</div>

@endsection
