@extends('layouts.admin')
@section('title','Dashboard Admin • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Selamat Datang, Admin!</h3>

    @if(($expiringTenantCount ?? 0) > 0)
    <div class="alert-custom mb-4 d-flex align-items-center">
        <i class="bi bi-exclamation-triangle me-2 fs-5"></i>
        <span>
            {{ $expiringTenantCount }} penyewa masa sewanya akan habis dalam waktu kurang dari 2 minggu.
            <a href="{{ route('admin.tenant.index', ['expiring' => 1]) }}" class="ms-2">Lihat daftar</a>
        </span>
    </div>
    @else
    <div class="alert-custom mb-4 d-flex align-items-center">
        <i class="bi bi-info-circle me-2 fs-5"></i>
        <span>Tidak ada penghuni yang masa sewanya akan habis dalam 2 minggu ke depan.</span>
    </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-body p-3">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-bell fs-4 text-primary me-2" aria-hidden="true"></i>
                <h5 class="mb-0">Notifikasi</h5>
                @if(($totalNotifications ?? 0) > 0)
                    <span class="badge bg-danger ms-3">{{ $totalNotifications }}</span>
                @else
                    <small class="text-muted ms-3">Tidak ada notifikasi baru</small>
                @endif
            </div>

            @if(($totalNotifications ?? 0) > 0)
            <ul class="list-group list-group-flush">
                @if(($pendingAccountCount ?? 0) > 0)
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-person-plus text-success me-3 fs-4"></i>
                    <div>
                        <div class="fw-semibold">{{ $pendingAccountCount }} akun penghuni menunggu konfirmasi</div>
                        <div class="small text-muted">
                            @foreach($latestPendingAccounts as $u)
                                {{ $u->name }} &middot; <span class="text-muted">{{ $u->created_at->diffForHumans() }}</span>@if(! $loop->last), @endif
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('admin.account.index', ['pending' => 1]) }}" class="btn btn-sm btn-outline-primary ms-auto">Lihat</a>
                </li>
                @endif

                @if(($rentalExtensionCount ?? 0) > 0)
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-clock-history text-warning me-3 fs-4"></i>
                    <div>
                        <div class="fw-semibold">{{ $rentalExtensionCount }} permohonan perpanjangan sewa baru</div>
                        <div class="small text-muted">
                            @foreach($latestRentalExtensions as $r)
                                {{ $r->tenant->nama_penghuni ?? '—' }} &middot; <span class="text-muted">{{ $r->tanggal_pengajuan }}</span>@if(! $loop->last), @endif
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('admin.rental_extension.index') }}" class="btn btn-sm btn-outline-primary ms-auto">Lihat</a>
                </li>
                @endif

                @if(($complaintCount ?? 0) > 0)
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-chat-dots text-danger me-3 fs-4"></i>
                    <div>
                        <div class="fw-semibold">{{ $complaintCount }} keluhan baru</div>
                        <div class="small text-muted">
                            @foreach($latestComplaints as $c)
                                {{ $c->user->name ?? '—' }} &middot; <span class="text-muted">{{ $c->tanggal_ajukan }}</span>@if(! $loop->last), @endif
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('admin.complaint.index') }}" class="btn btn-sm btn-outline-primary ms-auto">Lihat</a>
                </li>
                @endif

                @if(($expiringTenantCount ?? 0) > 0)
                <li class="list-group-item d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle text-secondary me-3 fs-4"></i>
                    <div>
                        <div class="fw-semibold">{{ $expiringTenantCount }} penyewa masa sewanya akan habis &lt; 2 minggu</div>
                        <div class="small text-muted">
                            @foreach($latestExpiringTenants as $t)
                                {{ $t->nama_penghuni ?? '—' }} &middot; <span class="text-muted">{{ $t->tanggal_keluar }}</span>@if(! $loop->last), @endif
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('admin.tenant.index', ['expiring' => 1]) }}" class="btn btn-sm btn-outline-primary ms-auto">Lihat</a>
                </li>
                @endif
            </ul>
            @endif
        </div>
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
            <a href="{{ route('admin.rental_extension.index') }}" class="dashboard-card">
                <i class="bi bi-clock-history"></i><h6>Perpanjangan Sewa @if(($rentalExtensionCount ?? 0) > 0) <span class="badge bg-danger ms-2">{{ $rentalExtensionCount }}</span> @endif</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.account.index') }}" class="dashboard-card">
                <i class="bi bi-person-lines-fill"></i><h6>Kelola Akun @if(($pendingAccountCount ?? 0) > 0) <span class="badge bg-danger ms-2">{{ $pendingAccountCount }}</span> @endif</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.tenant.index') }}" class="dashboard-card">
                <i class="bi bi-person-badge"></i><h6>Kelola Penghuni</h6>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('admin.complaint.index') }}" class="dashboard-card">
                <i class="bi bi-chat-dots"></i><h6>Status Keluhan @if(($complaintCount ?? 0) > 0) <span class="badge bg-danger ms-2">{{ $complaintCount }}</span> @endif</h6>
            </a>
        </div>
    </div>
@endsection
