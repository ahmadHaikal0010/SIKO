@extends('layouts.admin_sidebar')
@section('title','Tambah Kos')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold">Tambah Kos</h4>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">Periksa kembali input Anda.</div>
  @endif

  <div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.kost.store') }}" method="POST">
      @csrf
      @include('admin.kost._form', ['kost' => new \App\Models\Kost()])
    </form>
  </div>
@endsection
