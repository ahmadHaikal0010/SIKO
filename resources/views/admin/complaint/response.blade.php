@extends('layouts.admin_sidebar')
@section('title','Tanggapi Keluhan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Tanggapi Keluhan</h3>

    {{-- card detail keluhan (read only) --}}
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="mb-1">{{ $complaint->judul_keluhan }}</h5>
            <div class="small text-muted">
                Diajukan oleh: {{ $complaint->user->name ?? '-' }} — {{ $complaint->created_at->format('d M Y') }}
            </div>
            <hr>
            <p class="mb-0">{{ $complaint->isi_keluhan }}</p>

            @if($complaint->attachment)
                <div class="mt-3">
                    <a href="{{ $complaint->attachment_url }}" target="_blank" class="btn btn-outline-primary">
                        Lihat Lampiran
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- form tanggapan --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.complaint.response', $complaint->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    @php $selectedStatus = old('status', $complaint->status ?? 'menunggu'); @endphp
                    <select name="status" class="form-select">
                        
                        <option value="ditanggapi" {{ $selectedStatus === 'ditanggapi' ? 'selected' : '' }}>Ditanggapi</option>
                        <option value="selesai" {{ $selectedStatus === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggapan</label>
                    <textarea name="tanggapan" class="form-control" rows="4">{{ old('tanggapan', $complaint->tanggapan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Tanggapan</label>
                    <input type="date" name="tanggal_tanggapan" class="form-control"
                        value="{{ old('tanggal_tanggapan', $complaint->tanggal_tanggapan
                            ? \Carbon\Carbon::parse($complaint->tanggal_tanggapan)->toDateString()
                            : now()->toDateString()
                        ) }}">
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.complaint.show', $complaint->id) }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button class="btn btn-primary" type="submit">Simpan Tanggapan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
