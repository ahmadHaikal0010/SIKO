@extends('layouts.admin_sidebar')
@section('title','Edit Kamar')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Edit Kamar</h4>
    <a href="{{ route('admin.room.index') }}" class="btn btn-outline-secondary">← Kembali</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">Periksa input Anda.</div>
  @endif

  <div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.room.update',$room) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Pilih Kos</label>
        <select name="kost_id" class="form-select">
          @foreach($kosts as $k)
            <option value="{{ $k->id }}" {{ old('kost_id',$room->kost_id)==$k->id?'selected':'' }}>
              {{ $k->nama_kost }}
            </option>
          @endforeach
        </select>
        @error('kost_id')
    <div class="text-danger small mt-1">{{ $message }}</div>
  @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Nomor Kamar</label>
        <input type="text" name="nomor_kamar" class="form-control" value="{{ old('nomor_kamar',$room->nomor_kamar) }}">
        @error('nomor_kamar')
    <div class="text-danger small mt-1">{{ $message }}</div>
  @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="available" {{ old('status',$room->status)==='available'?'selected':'' }}>available</option>
          <option value="occupied"  {{ old('status',$room->status)==='occupied'?'selected':'' }}>occupied</option>
        </select>
        @error('status')
    <div class="text-danger small mt-1">{{ $message }}</div>
  @enderror
      </div>

      <button class="btn text-white" style="background:#6C8C5A">
        <i class="bi bi-check-lg me-1"></i> Perbarui
      </button>
    </form>
  </div>
@endsection
