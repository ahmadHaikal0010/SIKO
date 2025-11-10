@extends('layouts.admin_sidebar')
@section('title','Kelola Informasi Kos')

@section('content')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-semibold">Informasi Kos</h4>
    <a href="{{ route('admin.kost.create') }}" class="btn text-white" style="background:#6C8C5A">
      <i class="bi bi-plus-lg me-1"></i> Tambah Kos
    </a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-header text-white" style="background:#2B5955;">
      <div class="row">
        <div class="col-md-4 fw-semibold"><i class="bi bi-house-door me-2"></i>Nama Kos</div>
        <div class="col-md-2 fw-semibold"><i class="bi bi-tag me-2"></i>Kategori</div>
        <div class="col-md-2 fw-semibold"><i class="bi bi-door-open me-2"></i>Total Kamar</div>
        <div class="col-md-2 fw-semibold"><i class="bi bi-cash-coin me-2"></i>Harga/Tahun</div>
        <div class="col-md-2 fw-semibold"><i class="bi bi-diagram-3 me-2"></i>Aksi</div>
      </div>
    </div>

    <div class="list-group list-group-flush">
      @forelse($kost as $k)
        <div class="list-group-item">
          <div class="row align-items-center">
            <div class="col-md-4">
              <div class="d-flex align-items-center gap-3">
                <img src="{{ $k->cover_url }}" style="width:64px;height:48px;object-fit:cover;border-radius:8px" class="border">
                <div>
                  <div class="fw-semibold">{{ $k->nama_kost }}</div>
                  <div class="small text-muted">{{ Str::limit($k->alamat, 60) }}</div>
                </div>
              </div>
            </div>
            <div class="col-md-2">{{ ucfirst($k->kategori ?? '-') }}</div>
            <div class="col-md-2">{{ $k->total_kamar ?? '-' }}</div>
            <div class="col-md-2">Rp {{ number_format($k->harga_kost ?? 0,0,',','.') }}</div>
            <div class="col-md-2 d-flex gap-2">
              <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.kost.show',$k) }}" title="Detail">
                <i class="bi bi-eye"></i>
              </a>
              <a class="btn btn-sm btn-warning text-white" href="{{ route('admin.kost.edit',$k) }}" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.kost.destroy',$k) }}" method="POST" onsubmit="return confirm('Hapus data kos ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
              </form>
              {{-- Link ke halaman publik detail kos --}}
              <a class="btn btn-sm btn-outline-success" href="{{ route('kost.show',$k->id) }}" target="_blank" title="Lihat Halaman Publik">
                <i class="bi bi-box-arrow-up-right"></i>
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="list-group-item text-center text-muted py-5">Belum ada data kos.</div>
      @endforelse
    </div>
  </div>
@endsection
