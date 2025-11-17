@extends('layouts.admin_sidebar')
@section('title','Detail Kos')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Detail: {{ $kost->nama_kost }}</h4>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.kost.edit',$kost) }}" class="btn btn-warning text-white">
        <i class="bi bi-pencil me-1"></i> Edit
      </a>
      <a href="{{ route('kost.show', $kost->id) }}" target="_blank" class="btn btn-outline-success">
        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Halaman Publik
      </a>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header text-white" style="background:#2B5955;">
          <i class="bi bi-info-circle me-2"></i>Informasi Utama
        </div>
        <div class="card-body">
          <div class="mb-3">
            <div class="text-muted small">Alamat</div>
            <div class="fw-semibold">{{ $kost->alamat }}</div>
          </div>
          <div class="mb-3">
            <div class="text-muted small">Kategori</div>
            <div class="fw-semibold text-capitalize">{{ $kost->kategori }}</div>
          </div>
          <div class="mb-3">
            <div class="text-muted small">Total Kamar</div>
            <div class="fw-semibold">{{ $kost->total_kamar ?? '-' }}</div>
          </div>
          <div class="mb-3">
            <div class="text-muted small">Harga / Tahun</div>
            <div class="fw-semibold">Rp {{ number_format($kost->harga_kost ?? 0,0,',','.') }}</div>
          </div>
          <div class="mb-3">
            <div class="text-muted small">Deskripsi</div>
            <div>{{ $kost->deskripsi ?: '-' }}</div>
          </div>
          <div class="mb-3">
            <div class="text-muted small">Fasilitas</div>
            @if($kost->fasilitas)
              @php
                $items = collect(explode(',', $kost->fasilitas))
                  ->map(fn($s)=>trim($s))
                  ->filter();
              @endphp
              <ul class="mb-0">
                @foreach($items as $f)
                  <li>{{ $f }}</li>
                @endforeach
              </ul>
            @else
              <div>-</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-header text-white" style="background:#2B5955;">
          <i class="bi bi-image me-2"></i>Cover
        </div>
        <div class="card-body">
          <img src="{{ $kost->cover_url }}" class="w-100 rounded border" style="object-fit:cover;max-height:220px">
          <div class="form-text mt-2">
            Cover diambil dari foto galeri terbaru. Kelola di menu <a href="{{ route('admin.gallery.index') }}">Galeri Kost</a>.
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
