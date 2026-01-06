@extends('layouts.admin_sidebar')
@section('title','Data Kamar')

@push('styles')
<style>
  .headbar{background:#2B5955;color:#fff}
  .chip{font-weight:600;border-radius:999px;padding:.25rem .6rem;font-size:.85rem;display:inline-flex;align-items:center;gap:.35rem}
  .chip-available{background:#E6F6EE;color:#1B6B46;border:1px solid #BFE8D4}
  .chip-occupied {background:#FFE8E8;color:#8E2830;border:1px solid #FFC7C7}
  .chip-total{background:#EEF5F6;color:#28565B;border:1px solid #D0E7EA}

  .action-wrap .btn{
    width:52px;height:42px;
    display:inline-flex;align-items:center;justify-content:center;
    border-radius:12px;
  }
  .pagination { margin-bottom: 0; }
  .page-link { border-radius: 12px; }
</style>
@endpush

@section('content')
  {{-- Flash --}}
  @if (session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2">
      <i class="bi bi-check-circle"></i>
      <div>{{ session('success') }}</div>
    </div>
  @endif

  <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
      <h4 class="fw-semibold mb-1">Kelola Kamar</h4>
      <div class="text-muted small">Kelola data kamar untuk tiap kost.</div>
    </div>

    <a href="{{ route('admin.room.create') }}" class="btn text-white rounded-pill px-3" style="background:#6C8C5A">
      <i class="bi bi-plus-lg me-1"></i> Tambah Kamar
    </a>
  </div>

  {{-- Ringkasan --}}
  <div class="mb-3 d-flex gap-2 flex-wrap">
  <span class="chip chip-available">
    <i class="bi bi-check-circle"></i> Tersedia: {{ $totalAvailable }}
  </span>

  <span class="chip chip-occupied">
    <i class="bi bi-x-circle"></i> Terisi: {{ $totalOccupied }}
  </span>

  <span class="chip chip-total">
    <i class="bi bi-collection"></i> Total: {{ $totalRooms }}
  </span>
</div>


  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header headbar py-3">
      <div class="d-flex align-items-center justify-content-between">
        <div class="fw-semibold">
          <i class="bi bi-door-open me-2"></i> Daftar Kamar
        </div>
        <div class="small opacity-75">
          Total: {{ method_exists($rooms,'total') ? $rooms->total() : $rooms->count() }}
        </div>
      </div>
    </div>

    <div class="list-group list-group-flush">
      @forelse($rooms as $r)
        <div class="list-group-item py-4">
          <div class="row align-items-center g-3">
            <div class="col-lg-3 col-md-3">
              <div class="fw-semibold">
                <i class="bi bi-hash me-1 text-muted"></i>{{ $r->nomor_kamar }}
              </div>
              <div class="text-muted small">ID: {{ $r->id }}</div>
            </div>

            <div class="col-lg-4 col-md-4">
              <div class="fw-semibold">
                <i class="bi bi-house-door me-1 text-muted"></i>
                {{ $r->kost->nama_kost ?? '—' }}
              </div>
              <div class="text-muted small">Kost</div>
            </div>

            <div class="col-lg-3 col-md-3">
              @if($r->status === 'available')
                <span class="chip chip-available"><i class="bi bi-check2-circle"></i> available</span>
              @else
                <span class="chip chip-occupied"><i class="bi bi-person-fill"></i> occupied</span>
              @endif
            </div>

            <div class="col-lg-2 col-md-2">
              <div class="action-wrap d-flex gap-2 justify-content-md-end justify-content-start flex-wrap">
                <a href="{{ route('admin.room.show',$r) }}" class="btn btn-sm text-white" style="background:#4FA1BF"
                   data-bs-toggle="tooltip" data-bs-title="Lihat">
                  <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('admin.room.edit',$r) }}" class="btn btn-sm text-white" style="background:#D9A043"
                   data-bs-toggle="tooltip" data-bs-title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.room.destroy',$r) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm text-white" style="background:#E34B4B"
                          data-bs-toggle="tooltip" data-bs-title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="list-group-item text-center py-5">
          <div class="text-muted mb-2"><i class="bi bi-door-closed" style="font-size:2rem;"></i></div>
          <div class="fw-semibold">Belum ada data kamar.</div>
          <div class="text-muted small mb-3">Klik “Tambah Kamar” untuk menambahkan data.</div>
          <a href="{{ route('admin.room.create') }}" class="btn text-white rounded-pill px-3" style="background:#6C8C5A">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kamar
          </a>
        </div>
      @endforelse
    </div>

    {{-- Pagination (kalau rooms adalah paginator) --}}
    @if(method_exists($rooms,'links'))
      <div class="card-footer bg-white border-0 pt-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
          <div class="text-muted small">
            Menampilkan {{ $rooms->firstItem() }} - {{ $rooms->lastItem() }} dari {{ $rooms->total() }} data
          </div>
          <div>
            {{ $rooms->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
    new bootstrap.Tooltip(el);
  });
</script>
@endpush
