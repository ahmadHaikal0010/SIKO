@extends('layouts.admin')
{{-- Jika kamu pakai layout sidebar: ganti ke 'layouts.admin_sidebar' --}}

@section('title','Edit Foto Galeri')

@section('content')

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Edit Foto</h4>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
      &larr; Kembali
    </a>
  </div>

  {{-- Flash message --}}
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      Terjadi kesalahan. Periksa input Anda.
    </div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">

      {{-- PREVIEW FOTO (pakai accessor image_url dari model Gallery) --}}
      <div class="mb-4">
        <img
          src="{{ $gallery->image_url }}"
          alt="Preview Foto"
          class="rounded border w-100"
          style="max-height:360px; object-fit:cover;">
      </div>

      {{-- FORM --}}
      <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

       {{-- Pilih Kost --}}
<div class="mb-3">
  <label class="form-label">Pilih Kost</label>
  <select name="kost_id" class="form-select @error('kost_id') is-invalid @enderror">
    @foreach ($kost as $k)
      <option value="{{ $k->id }}" @selected($gallery->kost_id == $k->id)>{{ $k->nama_kost ?? 'Kost #'.$k->id }}</option>
    @endforeach
  </select>
  @error('kost_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- Judul
<div class="mb-3">
  <label class="form-label">Judul (opsional)</label>
  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
         value="{{ old('title', $gallery->title ?? '') }}">
  @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div> --}}

{{-- Ganti Foto --}}
<div class="mb-3">
  <label class="form-label">Ganti Foto (opsional)</label>
  <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
  <small class="text-muted">Kosongkan jika tidak ingin mengganti.</small>
  @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


        {{-- TOMBOL --}}
        <div class="pt-2">
          <button class="btn text-white" style="background:#6C8C5A;">
            <i class="bi bi-check-lg me-1"></i> Perbarui
          </button>
        </div>
      </form>

    </div>
  </div>

@endsection
