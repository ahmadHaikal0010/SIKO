@extends('layouts.admin')
@section('title','Detail Perpanjangan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Detail Perpanjangan</h3>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between">
                <div>
                    <a href="{{ route('admin.rental_extension.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
                <div>
                    @if($rentalExtension->status !== 'approved')
                        <form action="{{ route('admin.rental_extension.accept', $rentalExtension->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success">Setujui</button>
                        </form>
                    @endif

                    @if($rentalExtension->status !== 'rejected')
                        <form action="{{ route('admin.rental_extension.reject', $rentalExtension->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-warning">Tolak</button>
                        </form>
                    @endif

                    <form action="{{ route('admin.rental_extension.destroy', $rentalExtension->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permohonan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>

            <dl class="row">
                <dt class="col-sm-3">Penghuni</dt>
                <dd class="col-sm-9">{{ $rentalExtension->tenant->user->name ?? '-' }}</dd>

                <dt class="col-sm-3">Perpanjang Hingga</dt>
                <dd class="col-sm-9">{{ $rentalExtension->tanggal_selesai ? \Carbon\Carbon::parse($rentalExtension->tanggal_selesai)->format('d M Y') : '-' }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ ucfirst($rentalExtension->status) }}</dd>

                @if($rentalExtension->note)
                    <dt class="col-sm-3">Catatan</dt>
                    <dd class="col-sm-9">{{ $rentalExtension->note }}</dd>
                @endif
            </dl>
        </div>
    </div>
@endsection
