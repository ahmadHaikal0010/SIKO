@extends('layouts.admin_sidebar')
@section('title','Penghuni')

@section('content')
  @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-semibold">Data Penghuni</h4>
    <a href="{{ route('admin.tenant.create') }}" class="btn text-white" style="background:#2B5955">
      <i class="bi bi-plus-lg me-1"></i> Tambah Penghuni
    </a>
  </div>

  {{-- Filter ringan (opsional jika service sudah siapkan data) --}}
  <form class="row g-2 mb-3" method="get">
    <div class="col-md-3">
      <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama / telpon">
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select">
        <option value="">Semua Status</option>
        <option value="active" @selected(request('status')=='active')>Aktif</option>
        <option value="pending" @selected(request('status')=='pending')>Menunggu</option>
        <option value="finished" @selected(request('status')=='finished')>Selesai</option>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-outline-secondary w-100"><i class="bi bi-funnel"></i> Filter</button>
    </div>
  </form>

  <div class="card border-0 shadow-sm">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Kamar</th>
            <th>Kost</th>
            <th>Telpon</th>
            <th>Masuk</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tenants as $t)
            <tr>
              <td>{{ $loop->iteration + ($tenants->firstItem() - 1) }}</td>
              <td class="fw-semibold">{{ $t->nama_penghuni }}</td>
              <td>{{ $t->room?->nomor_kamar ?? '-' }}</td>
              <td>{{ $t->room?->kost?->nama_kost ?? '-' }}</td>
              <td>{{ $t->telpon ?: '-' }}</td>
              <td>{{ $t->tanggal_masuk ? \Carbon\Carbon::parse($t->tanggal_masuk)->format('d M Y') : '-' }}</td>
              <td>
                @php
                  $map = ['active'=>'success','pending'=>'warning','finished'=>'secondary'];
                @endphp
                <span class="badge bg-{{ $map[$t->status] ?? 'secondary' }}">{{ ucfirst($t->status) }}</span>
              </td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.tenant.show',$t) }}"><i class="bi bi-eye"></i></a>
                <a class="btn btn-sm btn-outline-warning" href="{{ route('admin.tenant.edit',$t) }}"><i class="bi bi-pencil-square"></i></a>
                <form action="{{ route('admin.tenant.destroy',$t) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus penghuni ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data penghuni.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if(method_exists($tenants,'links'))
      <div class="card-footer bg-white">
        {{ $tenants->withQueryString()->links() }}
      </div>
    @endif
  </div>
@endsection
