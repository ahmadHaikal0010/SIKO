@extends('layouts.admin_sidebar')
@section('title','Detail Transaksi')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Detail Transaksi</h4>
    <a href="{{ route('admin.transaction.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <div class="text-muted small">Penghuni</div>
          <div class="fw-semibold">{{ $transaction->tenant?->nama_penghuni ?? '-' }}</div>
        </div>
        <div class="col-md-6">
          <div class="text-muted small">Jumlah Bayar</div>
          <div class="fw-semibold">Rp {{ number_format($transaction->jumlah_bayar ?? 0,0,',','.') }}</div>
        </div>
        <div class="col-md-4">
          <div class="text-muted small">Tanggal Bayar</div>
          <div class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($transaction->tanggal_bayar)->format('d M Y') }}</div>
        </div>
        <div class="col-md-4">
          <div class="text-muted small">Periode Mulai</div>
          <div class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($transaction->periode_mulai)->format('d M Y') }}</div>
        </div>
        <div class="col-md-4">
          <div class="text-muted small">Periode Selesai</div>
          <div class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($transaction->periode_selesai)->format('d M Y') }}</div>
        </div>
        <div class="col-md-4">
          <div class="text-muted small">Metode</div>
          @php $labels=['cash'=>'Cash','bank_transfer'=>'Transfer Bank','e_wallet'=>'E-Wallet','cicilan'=>'Cicilan']; @endphp
          <div><span class="badge bg-secondary">{{ $labels[$transaction->metode_pembayaran] ?? $transaction->metode_pembayaran }}</span></div>
        </div>
      </div>
    </div>
  </div>
@endsection
