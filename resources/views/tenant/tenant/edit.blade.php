@extends('layouts.tenant')
@section('title','Ubah Data Penghuni • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Ubah Data Penghuni</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.tenant.update') }}" method="POST">
                @csrf
                @method('PUT')

                @include('tenant.tenant._form')

                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('tenant.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
