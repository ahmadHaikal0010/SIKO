{{-- resources/views/admin/gallery/create.blade.php --}}
@extends('layouts.admin')
@section('title','Tambah Foto Galeri')

@section('content')
  {{-- Flash error global --}}
  @if ($errors->any())
    <div class="alert alert-danger">Terjadi kesalahan. Periksa input Anda.</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-semibold text-dark">Tambah Foto</h4>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
  </div>

  <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data"
        class="card border-0 shadow-sm p-4">
    @csrf

    @isset($kost)
      <div class="mb-3">
        <label class="form-label">Pilih Kost</label>
        <select name="kost_id" class="form-select @error('kost_id') is-invalid @enderror">
          @foreach ($kost as $k)
            <option value="{{ $k->id }}" @selected(old('kost_id') == $k->id)>
              {{ $k->nama_kost ?? $k->name ?? ('Kost #'.$k->id) }}
            </option>
          @endforeach
        </select>
        @error('kost_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    @endisset

    {{-- <div class="mb-3">
      <label class="form-label">Judul (opsional)</label>
      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
             value="{{ old('title') }}">
      @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div> --}}

    <div class="mb-3">
      <label class="form-label">Unggah Foto (boleh lebih dari satu)</label>
      <input type="file" name="images[]" accept="image/*" multiple
             class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
      <div class="form-text">PNG/JPG/WEBP, disarankan ≤ 2MB per file.</div>
      @error('images') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
      @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    <div class="pt-2 d-flex gap-2">
      <button class="btn text-white" style="background:#6C8C5A;">
        <i class="bi bi-check-lg me-1"></i> Simpan
      </button>
      <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
@endsection
