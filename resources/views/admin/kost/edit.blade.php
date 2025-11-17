@extends('layouts.admin_sidebar')
@section('title','Edit Kos')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold">Edit Kos</h4>
    <a href="{{ route('admin.kost.index') }}" class="btn btn-outline-secondary">← Kembali</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">Periksa kembali input Anda.</div>
  @endif

  <div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.kost.update', $kost) }}" method="POST">
      @csrf @method('PUT')
      @include('admin.kost._form', ['kost' => $kost])
    </form>
  </div>
@endsection
