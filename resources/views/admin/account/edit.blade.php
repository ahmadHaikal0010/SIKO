@extends('layouts.admin')
@section('title','Ubah Akun • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Ubah Akun</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.account.update', $account->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $account->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $account->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select">
                            <option value="admin" @if(old('role', $account->role) === 'admin') selected @endif>Admin</option>
                            <option value="penghuni" @if(old('role', $account->role) === 'penghuni') selected @endif>Penghuni</option>
                            <option value="user" @if(old('role', $account->role) === 'user') selected @endif>User</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="active" @if(old('status', $account->status) === 'active') selected @endif>Active</option>
                        </select>
                    </div>
                </div>

                <hr>
                <h6>Ubah Password</h6>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (kosongkan jika tidak diganti)</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.account.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
