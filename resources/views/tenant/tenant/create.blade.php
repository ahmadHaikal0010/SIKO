@extends('layouts.tenant')
@section('title','Lengkapi Data Penghuni • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Lengkapi Data Penghuni</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.tenant.store') }}" method="POST">
                @csrf

                @include('tenant.tenant._form', ['tenant' => null])

                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
