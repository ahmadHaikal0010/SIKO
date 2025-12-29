@extends('layouts.tenant')
@section('title','Riwayat Perpanjangan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Riwayat Perpanjangan Sewa</h3>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('tenant.rental_extension.create') }}" class="btn btn-primary">Ajukan Perpanjangan</a>
                    <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
                </div>
            </div>

            @if($rentalExtensions->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Perpanjang Hingga</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentalExtensions as $r)
                                <tr>
                                    <td>{{ $loop->iteration + ($rentalExtensions->currentPage()-1) * $rentalExtensions->perPage() }}</td>
                                    <td>{{ $r->tanggal_selesai ? \Carbon\Carbon::parse($r->tanggal_selesai)->format('d M Y') : '-' }}</td>
                                    <td>{{ ucfirst($r->status ?? 'pending') }}</td>
                                    <td>{{ $r->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('tenant.rental_extension.show', $r->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                        <a href="{{ route('tenant.rental_extension.edit', $r->id) }}" class="btn btn-sm btn-outline-secondary">Ubah</a>
                                        <form action="{{ route('tenant.rental_extension.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permohonan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $rentalExtensions->links() }}
                </div>
            @else
                <div class="text-muted">Belum ada permohonan perpanjangan.</div>
            @endif
        </div>
    </div>
@endsection
