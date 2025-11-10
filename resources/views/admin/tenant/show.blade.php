@extends('layouts.admin_sidebar')
@section('title','Detail Penghuni')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Detail Penghuni</h4>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.tenant.edit',$tenant) }}" class="btn btn-warning text-white"><i class="bi bi-pencil-square me-1"></i>Edit</a>
      <a href="{{ route('admin.tenant.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
          <span class="fw-semibold"><i class="bi bi-person-badge me-2"></i>Profil Penghuni</span>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6"><small class="text-muted">Nama</small><div class="fw-semibold">{{ $tenant->nama_penghuni }}</div></div>
            <div class="col-md-3"><small class="text-muted">Jenis Kelamin</small><div class="fw-semibold">{{ $tenant->jenis_kelamin }}</div></div>
            <div class="col-md-3"><small class="text-muted">Telpon</small><div class="fw-semibold">{{ $tenant->telpon ?: '-' }}</div></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6"><small class="text-muted">Pekerjaan</small><div class="fw-semibold">{{ $tenant->pekerjaan ?: '-' }}</div></div>
            <div class="col-md-6"><small class="text-muted">Status</small>
              @php $map=['active'=>'success','pending'=>'warning','finished'=>'secondary']; @endphp
              <div class="fw-semibold"><span class="badge bg-{{ $map[$tenant->status] ?? 'secondary' }}">{{ ucfirst($tenant->status) }}</span></div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6"><small class="text-muted">Nama Wali</small><div class="fw-semibold">{{ $tenant->nama_wali ?: '-' }}</div></div>
            <div class="col-md-6"><small class="text-muted">Telpon Wali</small><div class="fw-semibold">{{ $tenant->telpon_wali ?: '-' }}</div></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white">
          <span class="fw-semibold"><i class="bi bi-door-open me-2"></i>Info Kamar</span>
        </div>
        <div class="card-body">
          <div class="mb-2"><small class="text-muted">Kost</small><div class="fw-semibold">{{ $tenant->room?->kost?->nama_kost ?? '-' }}</div></div>
          <div class="mb-2"><small class="text-muted">Nomor Kamar</small><div class="fw-semibold">{{ $tenant->room?->nomor_kamar ?? '-' }}</div></div>
          <div class="mb-2"><small class="text-muted">Status Kamar</small><div class="fw-semibold">{{ $tenant->room?->status ?? '-' }}</div></div>
        </div>
      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
          <span class="fw-semibold"><i class="bi bi-calendar-event me-2"></i>Periode Sewa</span>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <small class="text-muted">Masuk</small>
              <div class="fw-semibold">{{ $tenant->tanggal_masuk ? \Carbon\Carbon::parse($tenant->tanggal_masuk)->format('d M Y') : '-' }}</div>
            </div>
            <div class="col-6">
              <small class="text-muted">Keluar</small>
              <div class="fw-semibold">{{ $tenant->tanggal_keluar ? \Carbon\Carbon::parse($tenant->tanggal_keluar)->format('d M Y') : '-' }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
