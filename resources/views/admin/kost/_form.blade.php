@php
  // opsi kategori
  $opsiKategori = ['putra' => 'Putra', 'putri' => 'Putri', 'campur' => 'Campur'];
@endphp

<div class="row g-3">
  <div class="col-lg-8">
    {{-- Nama Kos --}}
    <div class="mb-3">
      <label class="form-label">Nama Kos <span class="text-danger">*</span></label>
      <input type="text" name="nama_kost" class="form-control @error('nama_kost') is-invalid @enderror"
             value="{{ old('nama_kost', $kost->nama_kost ?? '') }}" placeholder="cth: Kos Mentari">
      @error('nama_kost') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Alamat --}}
    <div class="mb-3">
      <label class="form-label">Alamat <span class="text-danger">*</span></label>
      <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
             value="{{ old('alamat', $kost->alamat ?? '') }}" placeholder="Alamat lengkap">
      @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"
        placeholder="Deskripsi singkat kos (lokasi, keunggulan, dll)">{{ old('deskripsi', $kost->deskripsi ?? '') }}</textarea>
      @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Fasilitas --}}
    <div class="mb-3">
      <label class="form-label">Fasilitas</label>
      <textarea name="fasilitas" rows="4" class="form-control @error('fasilitas') is-invalid @enderror"
        placeholder="Pisahkan dengan koma, contoh: WiFi, Dapur bersama, Parkir motor">
        {{ old('fasilitas', $kost->fasilitas ?? '') }}
      </textarea>
      @error('fasilitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
      <div class="form-text">Format bebas. Di halaman publik nanti bisa kita tampilkan sebagai bullet list.</div>
    </div>
  </div>

  <div class="col-lg-4">
    {{-- Kategori --}}
    <div class="mb-3">
      <label class="form-label">Kategori <span class="text-danger">*</span></label>
      <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
        <option value="" disabled {{ old('kategori', $kost->kategori ?? '')==''?'selected':'' }}>Pilih kategori</option>
        @foreach($opsiKategori as $val=>$label)
          <option value="{{ $val }}" {{ old('kategori', $kost->kategori ?? '')==$val?'selected':'' }}>{{ $label }}</option>
        @endforeach
      </select>
      @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Total kamar --}}
    <div class="mb-3">
      <label class="form-label">Total Kamar</label>
      <input type="number" min="0" name="total_kamar" class="form-control @error('total_kamar') is-invalid @enderror"
             value="{{ old('total_kamar', $kost->total_kamar ?? '') }}" placeholder="cth: 20">
      @error('total_kamar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Harga tahunan --}}
    <div class="mb-3">
      <label class="form-label">Harga / Tahun (Rupiah)</label>
      <input type="number" min="0" step="1" name="harga_kost" class="form-control @error('harga_kost') is-invalid @enderror"
             value="{{ old('harga_kost', $kost->harga_kost ?? '') }}" placeholder="cth: 14000000">
      @error('harga_kost') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Tombol --}}
    <div class="d-flex gap-2 mt-2">
      <a href="{{ route('admin.kost.index') }}" class="btn btn-outline-secondary">Batal</a>
      <button class="btn text-white" style="background:#6C8C5A">
        <i class="bi bi-check-lg me-1"></i> Simpan
      </button>
    </div>
  </div>
</div>
