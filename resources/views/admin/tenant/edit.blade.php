@extends('layouts.admin_sidebar')
@section('title','Edit Penghuni')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold">Edit Penghuni</h4>
    <a href="{{ route('admin.tenant.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">Periksa input Anda.</div>
  @endif

  <div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.tenant.update', $tenant) }}" method="POST">
      @csrf @method('PUT')
      @include('admin.tenant._form', ['tenant' => $tenant])
      <div class="mt-4">
        <button class="btn text-white" style="background:#2B5955"><i class="bi bi-check-lg me-1"></i> Perbarui</button>
      </div>
    </form>
  </div>
@endsection
