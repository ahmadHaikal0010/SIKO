@extends('layouts.admin_sidebar')
@section('title','Transaksi')

@section('content')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Daftar Transaksi</h4>
    <a href="{{ route('admin.transaction.create') }}" class="btn btn-success">
      <i class="bi bi-plus-lg me-1"></i> Tambah Transaksi
    </a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Penghuni</th>
          <th>Jumlah Bayar</th>
          <th>Tanggal Bayar</th>
          <th>Periode</th>
          <th>Metode</th>
          <th style="width:160px">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($transactions as $i => $t)
          <tr>
            <td>{{ $transactions->firstItem() + $i }}</td>
            <td>{{ $t->tenant?->nama_penghuni ?? '-' }}</td>
            <td>Rp {{ number_format($t->jumlah_bayar ?? 0,0,',','.') }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($t->tanggal_bayar)->format('d M Y') }}</td>
            <td>
              {{ \Illuminate\Support\Carbon::parse($t->periode_mulai)->format('d M Y') }}
              &ndash;
              {{ \Illuminate\Support\Carbon::parse($t->periode_selesai)->format('d M Y') }}
            </td>
            <td>
              @php
                $labels = ['cash'=>'Cash','bank_transfer'=>'Transfer','e_wallet'=>'E-Wallet','cicilan'=>'Cicilan'];
              @endphp
              <span class="badge bg-secondary">{{ $labels[$t->metode_pembayaran] ?? $t->metode_pembayaran }}</span>
            </td>
            <td class="d-flex gap-2">
              <a href="{{ route('admin.transaction.show',$t) }}" class="btn btn-info btn-sm text-white">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.transaction.edit',$t) }}" class="btn btn-warning btn-sm text-white">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.transaction.destroy',$t) }}" method="POST"
                    onsubmit="return confirm('Hapus transaksi ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer bg-white">
      {{ $transactions->links() }}
    </div>
  </div>
@endsection
