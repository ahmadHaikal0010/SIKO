@extends('layouts.admin_sidebar')
@section('title','Data Kamar')

@push('styles')
<style>
  .headbar{background:#2B5955;color:#fff;border-radius:10px 10px 0 0}
  .chip{font-weight:600;border-radius:999px;padding:.25rem .6rem;font-size:.85rem}
  .chip-available{background:#E6F6EE;color:#1B6B46;border:1px solid #BFE8D4}
  .chip-occupied {background:#FFE8E8;color:#8E2830;border:1px solid #FFC7C7}
</style>
@endpush

@section('content')
  {{-- Flash --}}
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Kelola Kamar</h4>
    <a href="{{ route('admin.room.create') }}" class="btn text-white" style="background:#6C8C5A">
      <i class="bi bi-plus-lg me-1"></i> Tambah Kamar
    </a>
  </div>

  {{-- Ringkasan kecil --}}
  <div class="mb-3 d-flex gap-2 flex-wrap">
    <span class="chip chip-available">Tersedia: {{ $rooms->where('status','available')->count() }}</span>
    <span class="chip chip-occupied">Terisi: {{ $rooms->where('status','occupied')->count() }}</span>
    <span class="chip" style="background:#EEF5F6;color:#28565B;border:1px solid #D0E7EA">
      Total: {{ $rooms->count() }}
    </span>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="headbar px-3 py-2">
      <div class="row">
        <div class="col-md-3 fw-semibold"><i class="bi bi-hash me-2"></i>Nomor</div>
        <div class="col-md-4 fw-semibold"><i class="bi bi-house-door me-2"></i>Kos</div>
        <div class="col-md-3 fw-semibold"><i class="bi bi-circle-half me-2"></i>Status</div>
        <div class="col-md-2 fw-semibold"><i class="bi bi-diagram-3 me-2"></i>Aksi</div>
      </div>
    </div>

    <div class="list-group list-group-flush">
      @forelse($rooms as $r)
        <div class="list-group-item py-3">
          <div class="row align-items-center">
            <div class="col-md-3 fw-semibold">{{ $r->nomor_kamar }}</div>
            <div class="col-md-4">{{ $r->kost->nama_kost ?? '—' }}</div>
            <div class="col-md-3">
              @if($r->status === 'available')
                <span class="chip chip-available">available</span>
              @else
                <span class="chip chip-occupied">occupied</span>
              @endif
            </div>
            <div class="col-md-2 d-flex gap-2">
              <a href="{{ route('admin.room.show',$r) }}"  class="btn btn-sm text-white" style="background:#4FA1BF"><i class="bi bi-eye"></i></a>
              <a href="{{ route('admin.room.edit',$r) }}"  class="btn btn-sm text-white" style="background:#D9A043"><i class="bi bi-pencil"></i></a>
              <form action="{{ route('admin.room.destroy',$r) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm text-white" style="background:#E34B4B"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="list-group-item text-center text-muted py-5">Belum ada data kamar.</div>
      @endforelse
    </div>
  </div>

  <div class="mt-3">
    {{-- kalau pakai paginate di service: {{ $rooms->links() }} --}}
  </div>
@endsection
