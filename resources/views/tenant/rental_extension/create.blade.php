@extends('layouts.tenant')
@section('title','Ajukan Perpanjangan Sewa • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Ajukan Perpanjangan Sewa</h3>

    <div class="card">
        <div class="card-body">
            @php /** @var \App\Models\User|null $authUser */ $authUser = auth()->user(); @endphp
            @if(! $authUser || ! $authUser->tenant)
                <div class="alert alert-warning">Akun Anda belum terdaftar sebagai penghuni. Silakan hubungi admin untuk menambahkan data penghuni sebelum mengajukan perpanjangan.</div>
                <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
            @else
                <form action="{{ route('tenant.rental_extension.store') }}" method="POST">
                    @csrf

                    {{-- Hidden inputs required by backend --}}
                    <input type="hidden" name="tenant_id" value="{{ $authUser->tenant->id }}">
                    <input type="hidden" name="tanggal_pengajuan" value="{{ now()->format('Y-m-d') }}">
                    <input type="hidden" name="tanggal_mulai" value="{{ now()->addDay()->format('Y-m-d') }}">
                    <input type="hidden" name="status" value="pending">

                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Perpanjang Hingga</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" required>
                        @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
                        <a href="{{ route('tenant.rental_extension.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Ajukan Perpanjangan</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
