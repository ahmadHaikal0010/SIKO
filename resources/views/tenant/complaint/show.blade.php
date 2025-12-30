@extends('layouts.tenant')
@section('title','Detail Keluhan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Detail Keluhan</h3>

    <div class="card">
        <div class="card-body">
            @php /** @var \App\Models\User|null $authUser */ $authUser = auth()->user(); @endphp
            <div class="mb-3 d-flex justify-content-between">
                <div>
                    <a href="{{ route('tenant.complaint.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
                <div>
                    @if($authUser && $authUser->can('update', $complaint))
                        {{-- <a href="{{ route('tenant.complaint.edit', $complaint->id) }}" class="btn btn-secondary">Ubah</a> --}}
                    @endif
                </div>
            </div>

            <h5 class="fw-bold">{{ $complaint->judul_keluhan }}</h5>
            <div class="text-muted small mb-3">Status: <strong>{{ ucfirst($complaint->status) }}</strong></div>
            <p style="white-space:pre-line">{{ $complaint->isi_keluhan }}</p>

            @if($complaint->attachment)
                <div class="mt-3">
                    <a href="{{ $complaint->attachment_url }}" target="_blank" class="btn btn-outline-primary">Lihat Lampiran</a>
                </div>
            @endif
        </div>
    </div>
@endsection
