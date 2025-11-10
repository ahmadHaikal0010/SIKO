@extends('layouts.admin')
@section('title','Dashboard Admin • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Selamat Datang, Admin!</h3>

    <div class="alert-custom mb-4 d-flex align-items-center">
        <i class="bi bi-info-circle me-2 fs-5"></i>
        <span>3 penyewa masa sewanya akan berakhir minggu ini.</span>
    </div>

    <div class="row text-center gy-4">
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.gallery.index') }}" class="dashboard-card">
                <i class="bi bi-images"></i><h6>Kelola Galeri Kos</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.kost.index') }}" class="dashboard-card">
                <i class="bi bi-info-circle"></i><h6>Kelola Informasi Kos</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.room.index') }}" class="dashboard-card">
                <i class="bi bi-house-door"></i><h6>Kelola Kamar</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.transaction.index') }}" class="dashboard-card">
                <i class="bi bi-wallet2"></i><h6>Kelola Transaksi</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.transaction.index') }}" class="dashboard-card">
                <i class="bi bi-clock-history"></i><h6>Perpanjangan Sewa</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('profile.edit') }}" class="dashboard-card">
                <i class="bi bi-person-lines-fill"></i><h6>Kelola Akun</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.tenant.index') }}" class="dashboard-card">
                <i class="bi bi-person-badge"></i><h6>Kelola Penghuni</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.transaction.index') }}" class="dashboard-card">
                <i class="bi bi-chat-dots"></i><h6>Status Keluhan</h6>
            </a>
        </div>
    </div>
@endsection
