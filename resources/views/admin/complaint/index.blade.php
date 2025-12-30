@extends('layouts.admin_sidebar')
@section('title','Kelola Keluhan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Kelola Keluhan</h3>

    <div class="card">
        <div class="card-body">
            @if($complaints->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Penghuni</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Diajukan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $c)
                                <tr>
                                    <td>{{ $loop->iteration + ($complaints->currentPage()-1) * $complaints->perPage() }}</td>
                                    <td>{{ $c->user->name ?? '-' }}</td>
                                    <td>{{ $c->judul_keluhan }}</td>
                                    <td>{{ ucfirst($c->status ?? 'menunggu') }}</td>
                                    <td>{{ $c->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.complaint.show', $c->id) }}" class="btn btn-sm btn-outline-primary">
                                            Lihat
                                        </a>

                                        <a href="{{ route('admin.complaint.response.edit', $c->id) }}" class="btn btn-sm btn-primary">
                                            Tanggapi
                                        </a>

                                        <form action="{{ route('admin.complaint.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus aduan ini?')">
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

                <div class="mt-3">{{ $complaints->links() }}</div>
            @else
                <div class="text-muted">Belum ada keluhan masuk.</div>
            @endif
        </div>
    </div>
@endsection
