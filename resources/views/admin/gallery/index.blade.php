@php
    use Illuminate\Support\Facades\Storage;

    // Pakai closure (bukan function global) biar tidak "cannot redeclare"
    $imgUrl = fn($g) => $g->image_url;
@endphp

@extends('layouts.admin_sidebar')
@section('title','Galeri Kost')

@push('styles')
<style>
    .siko-btn-green { background:#6C8C5A; color:#fff; }
    .siko-btn-green:hover { background:#577447; color:#fff; }

    .siko-card-head {
        background:#2B5955;
        color:#fff;
    }

    .gallery-item { border-bottom: 1px solid rgba(0,0,0,.06); }
    .gallery-item:last-child { border-bottom: 0; }

    .gallery-thumb {
        width: 100%;
        max-width: 420px;
        height: 120px;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,.08);
        background: #eef3f2;
        position: relative;
    }
    .gallery-thumb img {
        position:absolute; inset:0;
        width:100%; height:100%;
        object-fit:cover;
    }

    .action-wrap .btn{
        width: 52px;
        height: 42px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border-radius:12px;
    }

    /* Pagination biar rapih */
    .pagination { margin-bottom: 0; }
    .page-link { border-radius: 12px; }

    @media (max-width: 576px){
        .gallery-thumb { max-width: 100%; height: 150px; }
        .action-wrap { width: 100%; }
        .action-wrap .btn { flex: 1; width: auto; }
        .action-wrap form { flex: 1; }
        .action-wrap form .btn { width: 100%; }
    }
</style>
@endpush

@section('content')
    {{-- Flash --}}
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle"></i>
            <div>Terjadi kesalahan. Periksa input.</div>
        </div>
    @endif

    {{-- Header + tombol tambah --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="mb-1 fw-semibold">Galeri Kost</h4>
            <div class="text-muted small">Kelola foto galeri untuk masing-masing kost.</div>
        </div>

        <a href="{{ route('admin.gallery.create') }}" class="btn siko-btn-green rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Foto
        </a>
    </div>

    {{-- List --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header siko-card-head py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="fw-semibold">
                    <i class="bi bi-image me-2"></i> Daftar Foto
                </div>
                <div class="small opacity-75">
                    Total: {{ method_exists($galleries,'total') ? $galleries->total() : $galleries->count() }}
                </div>
            </div>
        </div>

        <div class="list-group list-group-flush">
            @forelse ($galleries as $g)
                <div class="list-group-item gallery-item py-4">
                    <div class="row align-items-center g-3">
                        {{-- Left: thumbnail + info --}}
                        <div class="col-lg-8 col-md-7">
                            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3">
                                <div class="gallery-thumb">
                                    <img src="{{ $imgUrl($g) }}"
                                         alt="Foto Galeri"
                                         loading="lazy" decoding="async" fetchpriority="low">
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                        @if($g->kost?->nama_kost)
                                            <span class="badge rounded-pill text-bg-light border">
                                                <i class="bi bi-house-door me-1"></i>{{ $g->kost->nama_kost }}
                                            </span>
                                        @endif

                                        <span class="badge rounded-pill text-bg-light border">
                                            <i class="bi bi-clock me-1"></i>{{ optional($g->created_at)->format('d M Y H:i') }}
                                        </span>
                                    </div>

                                    @if(!empty($g->title))
                                        <div class="fw-semibold fs-6">{{ $g->title }}</div>
                                    @else
                                        <div class="fw-semibold fs-6">Foto Galeri</div>
                                    @endif

                                    <div class="text-muted small mt-1">ID: {{ $g->id }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Right: actions --}}
                        <div class="col-lg-4 col-md-5">
                            <div class="action-wrap d-flex gap-2 justify-content-md-end justify-content-start flex-wrap">
                                <a href="{{ route('admin.gallery.edit', $g) }}"
                                   class="btn btn-siko-yellow"
                                   data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="{{ route('admin.gallery.show', $g) }}"
                                   class="btn btn-siko-blue"
                                   data-bs-toggle="tooltip" data-bs-title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('admin.gallery.destroy', $g) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-siko-red"
                                            data-bs-toggle="tooltip" data-bs-title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="list-group-item text-center py-5">
                    <div class="text-muted mb-2">
                        <i class="bi bi-images" style="font-size:2rem;"></i>
                    </div>
                    <div class="fw-semibold">Belum ada foto galeri.</div>
                    <div class="text-muted small mb-3">Klik tombol “Tambah Foto” untuk menambahkan.</div>
                    <a href="{{ route('admin.gallery.create') }}" class="btn siko-btn-green rounded-pill px-3">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Foto
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination (Bootstrap 5) --}}
        @if(method_exists($galleries,'links'))
            <div class="card-footer bg-white border-0 pt-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <div class="text-muted small">
                        Menampilkan {{ $galleries->firstItem() }} - {{ $galleries->lastItem() }} dari {{ $galleries->total() }} data
                    </div>
                    <div>
                        {{ $galleries->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Aktifkan tooltip Bootstrap
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        new bootstrap.Tooltip(el);
    });
</script>
@endpush
