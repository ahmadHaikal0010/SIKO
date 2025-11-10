@php
    use Illuminate\Support\Facades\Storage;

    // Pakai closure (bukan function global) biar tidak "cannot redeclare"
    $imgUrl = fn($g) => $g->image_url;
@endphp

@extends('layouts.admin_sidebar')
@section('title','Galeri Kost')

@section('content')
  {{-- Flash --}}
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">Terjadi kesalahan. Periksa input.</div>
  @endif

  {{-- Header + tombol tambah --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-semibold">Galeri Kost</h4>
    <a href="{{ route('admin.gallery.create') }}" class="btn text-white" style="background:#6C8C5A;">
      <i class="bi bi-plus-lg me-1"></i> Tambah Foto
    </a>
  </div>

  {{-- Tabel/list --}}
  <div class="card border-0 shadow-sm">
    <div class="card-header text-white" style="background:#2B5955;">
      <div class="row">
        <div class="col-8 fw-semibold"><i class="bi bi-image me-2"></i>Foto</div>
        <div class="col-4 fw-semibold"><i class="bi bi-diagram-3 me-2"></i>Aksi</div>
      </div>
    </div>

            <div class="list-group list-group-flush">
        @forelse ($galleries as $g)
            <div class="list-group-item py-4">
            <div class="row align-items-center g-3">
                <div class="col-md-8 d-flex align-items-center gap-3">
                <div class="position-relative rounded border overflow-hidden" style="width:100%; max-width:420px; aspect-ratio:21/8;">
                    <img src="{{ $imgUrl($g) }}" alt="Foto Galeri"
                        class="position-absolute top-0 start-0 w-100 h-100"
                        style="object-fit:cover;" loading="lazy" decoding="async" fetchpriority="low">
                </div>

                <div class="flex-grow-1">
                    @if($g->kost?->nama_kost)
                    <span class="badge rounded-pill text-bg-light border mb-2">{{ $g->kost->nama_kost }}</span>
                    @endif
                    @if(!empty($g->title))
                    <div class="fw-semibold">{{ $g->title }}</div>
                    @endif
                    <div class="text-muted small">Diunggah {{ optional($g->created_at)->format('d M Y H:i') }}</div>
                </div>
                </div>

                <div class="col-md-4 d-flex gap-2 justify-content-md-start justify-content-center">
                <a href="{{ route('admin.gallery.edit', $g) }}" class="btn btn-siko-yellow" style="width:56px" data-bs-toggle="tooltip" data-bs-title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="{{ route('admin.gallery.show', $g) }}" class="btn btn-siko-blue" style="width:56px" data-bs-toggle="tooltip" data-bs-title="Lihat">
                    <i class="bi bi-eye"></i>
                </a>
                <form action="{{ route('admin.gallery.destroy', $g) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-siko-red" style="width:56px" data-bs-toggle="tooltip" data-bs-title="Hapus">
                    <i class="bi bi-trash"></i>
                    </button>
                </form>
                </div>
            </div>
            </div>
        @empty
            <div class="list-group-item text-center text-muted py-5">Belum ada foto galeri.</div>
        @endforelse
        </div>

        @if(method_exists($galleries,'links'))
        <div class="mt-3">{{ $galleries->withQueryString()->links() }}</div>
        @endif

    </div>
  </div>
@endsection
