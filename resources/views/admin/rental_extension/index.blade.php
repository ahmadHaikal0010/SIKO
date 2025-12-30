@extends('layouts.admin_sidebar')
@section('title','Perpanjangan Sewa • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Kelola Perpanjangan Sewa</h3>

    <div class="card">
        <div class="card-body">
            @if($rentalExtensions->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Penghuni</th>
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
                                    <td>{{ $r->tenant->user->name ?? '-' }}</td>
                                    <td>{{ $r->tanggal_selesai ? \Carbon\Carbon::parse($r->tanggal_selesai)->format('d M Y') : '-' }}</td>
                                    <td>{{ ucfirst($r->status ?? 'pending') }}</td>
                                    <td>{{ $r->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.rental_extension.show', $r->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>

                                        @if($r->status !== 'approved')
                                            <form action="{{ route('admin.rental_extension.accept', $r->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-success">Setujui</button>
                                            </form>
                                        @endif

                                        @if($r->status !== 'rejected')
                                            <form action="{{ route('admin.rental_extension.reject', $r->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-warning">Tolak</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.rental_extension.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permohonan ini?')">
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

                <div class="mt-3">{{ $rentalExtensions->links() }}</div>
            @else
                <div class="text-muted">Belum ada permohonan perpanjangan.</div>
            @endif
        </div>
    </div>
@endsection
