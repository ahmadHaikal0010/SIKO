@extends('layouts.admin_sidebar')
@section('title','Detail Kamar')

@push('styles')
<style>
  .chip{font-weight:600;border-radius:999px;padding:.25rem .6rem;font-size:.85rem}
  .chip-available{background:#E6F6EE;color:#1B6B46;border:1px solid #BFE8D4}
  .chip-occupied {background:#FFE8E8;color:#8E2830;border:1px solid #FFC7C7}
</style>
@endpush

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Detail Kamar</h4>
    <a href="{{ route('admin.room.index') }}" class="btn btn-outline-secondary">← Kembali</a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <div class="mb-2"><small class="text-muted">Kos</small><div class="fw-semibold">{{ $room->kost->nama_kost ?? '—' }}</div></div>
      <div class="mb-2"><small class="text-muted">Nomor Kamar</small><div class="fw-semibold">{{ $room->nomor_kamar }}</div></div>
      <div class="mb-2"><small class="text-muted">Status</small>
        <div>
          @if($room->status==='available')
            <span class="chip chip-available">available</span>
          @else
            <span class="chip chip-occupied">occupied</span>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
