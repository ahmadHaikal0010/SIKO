@extends('layouts.tenant')
@section('title','Riwayat Keluhan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Riwayat Keluhan</h3>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('tenant.complaint.create') }}" class="btn btn-primary">Ajukan Keluhan</a>
                    <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
                </div>
                <div>
                    {{-- simple search if desired in future --}}
                </div>
            </div>

            @if($complaints->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $c)
                                <tr>
                                    <td>{{ $loop->iteration + ($complaints->currentPage()-1) * $complaints->perPage() }}</td>
                                    <td>{{ $c->judul_keluhan }}</td>
                                    <td>{{ ucfirst($c->status ?? 'pending') }}</td>
                                    <td>{{ $c->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('tenant.complaint.show', $c->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                        
                                        <form action="{{ route('tenant.complaint.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus aduan ini?')">
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
                    {{ $complaints->links() }}
                </div>
            @else
                <div class="text-muted">Belum ada aduan.</div>
            @endif
        </div>
    </div>
@endsection
