@extends('layouts.admin_sidebar')
@section('title','Kelola Akun • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Kelola Akun</h3>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.account.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>

            @if(auth()->user()->role === 'admin')
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Akun Admin Anda</strong>
                            <div class="text-muted small">{{ auth()->user()->name }} — {{ auth()->user()->email }}</div>
                        </div>
                        <div>
                            <a href="{{ route('admin.account.edit', auth()->id()) }}" class="btn btn-sm btn-outline-secondary">Ubah</a>
                            <a href="{{ route('admin.account.show', auth()->id()) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                        </div>
                    </div>
                </div>
            @endif

            @if($accounts->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $a)
                                <tr>
                                    <td>{{ $loop->iteration + ($accounts->currentPage()-1) * $accounts->perPage() }}</td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->role }}</td>
                                    <td>{{ $a->is_accepted ?? 'pending' }}</td>
                                    <td>

                                        @if($a->is_accepted !== 'accepted')
                                            <form action="{{ route('admin.account.accept', $a->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-success">Terima</button>
                                            </form>
                                        @endif

                                        @if($a->is_accepted !== 'rejected')
                                            <form action="{{ route('admin.account.reject', $a->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-warning">Tolak</button>
                                            </form>
                                        @endif



                                        <a href="{{ route('admin.account.edit', $a->id) }}" class="btn btn-sm btn-outline-secondary">Ubah</a>
                                        <a href="{{ route('admin.account.show', $a->id) }}" class="btn btn-sm btn-outline-primary">Lihat</a>

                                        @if(auth()->id() !== $a->id)
                                            <form action="{{ route('admin.account.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus akun ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-outline-danger" disabled>Hapus</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $accounts->links() }}</div>
            @else
                <div class="text-muted">Belum ada akun.</div>
            @endif
        </div>
    </div>
@endsection
