@extends('layouts.admin_sidebar')
@section('title','Tambah Transaksi')

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">Periksa input Anda.</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Tambah Transaksi</h4>
    <a href="{{ route('admin.transaction.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
  </div>

  <div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.transaction.store') }}" method="POST">
      @csrf
      @include('admin.transaction._form', ['transaction' => new \App\Models\Transaction, 'tenants' => $tenants])
      <div class="mt-3">
        <button class="btn btn-success"><i class="bi bi-check-lg me-1"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
