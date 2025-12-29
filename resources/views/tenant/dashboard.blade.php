@extends('layouts.tenant')
@section('title','Dashboard Penghuni • SIKO')

@section('content')
    @php /** @var \App\Models\User|null $authUser */ $authUser = auth()->user(); @endphp

    <h3 class="mb-3 fw-semibold text-dark">Selamat Datang, {{ $authUser->name ?? 'Penghuni' }}!</h3>

    @if(!empty($needsTenant))
        <div class="alert alert-warning d-flex justify-content-between align-items-center mb-4">
            <div>
                <strong>Perhatian!</strong> Silakan lengkapi data penghuni Anda terlebih dahulu.
            </div>
            <a href="{{ route('tenant.tenant.create') }}" class="btn btn-primary">Lengkapi Data Penghuni</a>
        </div>
    @endif

    <div class="alert-custom mb-4 d-flex align-items-center">
        <i class="bi bi-info-circle me-2 fs-5"></i>
        <span>Periksa status keluhan dan ajukan perpanjangan sewa dari dashboard ini.</span>
    </div>

    <div class="row text-center gy-4">
        <div class="col-md-3 col-6">
            <a href="{{ route('tenant.complaint.create') }}" class="dashboard-card">
                <i class="bi bi-pen"></i><h6>Ajukan Keluhan</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('tenant.complaint.index') }}" class="dashboard-card">
                <i class="bi bi-chat-dots"></i><h6>Riwayat Keluhan</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('tenant.rental_extension.create') }}" class="dashboard-card">
                <i class="bi bi-clock-history"></i><h6>Ajukan Perpanjangan Sewa</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('tenant.rental_extension.index') }}" class="dashboard-card">
                <i class="bi bi-list-check"></i><h6>Riwayat Perpanjangan</h6>
            </a>
        </div>

        <div class="col-md-3 col-6 mt-3">
            <a href="{{ route('profile.edit') }}" class="dashboard-card">
                <i class="bi bi-person-lines-fill"></i><h6>Kelola Akun</h6>
            </a>
        </div>
    </div>
@endsection
