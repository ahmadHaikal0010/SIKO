@extends('layouts.tenant')
@section('title','Detail Perpanjangan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Detail Perpanjangan Sewa</h3>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between">
                <div>
                    <a href="{{ route('tenant.rental_extension.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
                <div>
                    <a href="{{ route('tenant.rental_extension.edit', $rentalExtension->id) }}" class="btn btn-secondary">Ubah</a>
                </div>
            </div>

            <div class="mb-2">
                <strong>Perpanjang Hingga:</strong> {{ $rentalExtension->tanggal_selesai ? \Carbon\Carbon::parse($rentalExtension->tanggal_selesai)->format('d M Y') : '-' }}
            </div>

            <div class="mb-2">
                <strong>Status:</strong> {{ ucfirst($rentalExtension->status) }}
            </div>

            @if(!empty($rentalExtension->note))
                <div class="mb-2">
                    <strong>Catatan:</strong>
                    <p style="white-space:pre-line">{{ $rentalExtension->note }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
