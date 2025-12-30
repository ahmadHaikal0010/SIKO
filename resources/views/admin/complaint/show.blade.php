@extends('layouts.admin_sidebar')
@section('title','Keluhan • SIKO')

@section('content')
    <h3 class="mb-3 fw-semibold text-dark">Detail Keluhan</h3>

    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <h5>{{ $complaint->judul_keluhan }}</h5>
                <div class="small text-muted">
                    Diajukan oleh: {{ $complaint->user->name ?? '-' }} — {{ $complaint->created_at->format('d M Y') }}
                </div>
                <hr>
                <p>{{ $complaint->isi_keluhan }}</p>
            </div>

            @if($complaint->attachment)
                <div class="mb-3">
                    <a href="{{ $complaint->attachment_url }}" target="_blank" class="btn btn-outline-primary">
                        Lihat Lampiran
                    </a>
                </div>
            @endif

            @if($complaint->tanggapan)
                <div class="mb-4">
                    <h6>Respons sebelumnya</h6>
                    <div class="small text-muted">
                        {{ $complaint->tanggal_tanggapan
                            ? \Carbon\Carbon::parse($complaint->tanggal_tanggapan)->format('d M Y')
                            : $complaint->updated_at->format('d M Y') }}
                    </div>
                    <p>{{ $complaint->tanggapan }}</p>
                    <hr>
                </div>
            @endif

            {{-- tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-3 text-end">
                <form action="{{ route('admin.complaint.destroy', $complaint->id) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus aduan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
