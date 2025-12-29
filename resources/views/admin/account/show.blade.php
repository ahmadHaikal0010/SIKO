@extends('layouts.admin')
@section('title','Detail Akun • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Detail Akun</h3>

    @php
        // controller may pass either $account or $user due to naming; normalize
        $u = $account ?? $user ?? null;
    @endphp

    @if(!$u)
        <div class="alert alert-warning">Data pengguna tidak tersedia.</div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <a href="{{ route('admin.account.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    <div>
                        <a href="{{ route('admin.account.edit', $u->id) }}" class="btn btn-secondary">Ubah</a>
                    </div>
                </div>

                <dl class="row">
                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-9">{{ $u->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $u->email }}</dd>

                    <dt class="col-sm-3">Role</dt>
                    <dd class="col-sm-9">{{ $u->role }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">{{ $u->is_accepted ?? 'pending' }}</dd>

                    @if($u->tenant)
                        <dt class="col-sm-3">Kost / Unit</dt>
                        <dd class="col-sm-9">{{ $u->tenant->kost->nama_kost ?? '-' }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    @endif
@endsection
