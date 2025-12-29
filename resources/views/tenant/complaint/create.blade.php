@extends('layouts.tenant')
@section('title','Ajukan Keluhan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Ajukan Keluhan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.complaint.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Hidden values required by backend --}}
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="tanggal_ajukan" value="{{ now()->format('Y-m-d') }}">
                <input type="hidden" name="status" value="menunggu">

                <div class="mb-3">
                    <label for="judul_keluhan" class="form-label">Judul</label>
                    <input type="text" name="judul_keluhan" id="judul_keluhan" class="form-control @error('judul_keluhan') is-invalid @enderror" value="{{ old('judul_keluhan') }}" required>
                    @error('judul_keluhan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="isi_keluhan" class="form-label">Deskripsi</label>
                    <textarea name="isi_keluhan" id="isi_keluhan" rows="5" class="form-control @error('isi_keluhan') is-invalid @enderror" required>{{ old('isi_keluhan') }}</textarea>
                    @error('isi_keluhan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="attachment" class="form-label">Lampiran (opsional)</label>
                    <input type="file" name="attachment" id="attachment" class="form-control @error('attachment') is-invalid @enderror">
                    @error('attachment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
                    <a href="{{ route('tenant.complaint.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Kirim Keluhan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
