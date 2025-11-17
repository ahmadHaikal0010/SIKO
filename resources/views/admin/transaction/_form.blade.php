@php
  // Metode pembayaran (harus match dengan rules)
  $methods = [
    'cash' => 'Cash',
    'bank_transfer' => 'Transfer Bank',
    'e_wallet' => 'E-Wallet',
    'cicilan' => 'Cicilan',
  ];
@endphp

<div class="row g-3">

  {{-- Tenant --}}
  <div class="col-md-6">
    <label for="tenant_id" class="form-label">Penghuni</label>
    <select id="tenant_id" name="tenant_id" class="form-select @error('tenant_id') is-invalid @enderror" required>
      <option value="">— Pilih Penghuni —</option>
      @foreach($tenants as $ten)
        @php
          $desc = trim(($ten->nama_penghuni ?? $ten->user?->name ?? '-') . ' • ' . ($ten->room?->nomor_kamar ?? '-'));
        @endphp
        <option value="{{ $ten->id }}" @selected(old('tenant_id', $transaction->tenant_id ?? null) == $ten->id)>
          {{ $desc }}
        </option>
      @endforeach
    </select>
    @error('tenant_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  {{-- Jumlah Bayar --}}
  <div class="col-md-6">
    <label for="jumlah_bayar" class="form-label">Jumlah Bayar (Rp)</label>
    <input id="jumlah_bayar" type="number" step="1" min="0" name="jumlah_bayar"
           class="form-control @error('jumlah_bayar') is-invalid @enderror"
           value="{{ old('jumlah_bayar', $transaction->jumlah_bayar ?? '') }}" required>
    @error('jumlah_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    <small class="text-muted">Masukkan angka tanpa titik/koma. Ditampilkan sebagai Rupiah di daftar.</small>
  </div>

  {{-- Tanggal Bayar --}}
  <div class="col-md-6">
    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
    <input id="tanggal_bayar" type="date" name="tanggal_bayar"
           class="form-control @error('tanggal_bayar') is-invalid @enderror"
           value="{{ old('tanggal_bayar', isset($transaction->tanggal_bayar) ? \Illuminate\Support\Carbon::parse($transaction->tanggal_bayar)->format('Y-m-d') : '') }}"
           required>
    @error('tanggal_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  {{-- Periode --}}
  <div class="col-md-3">
    <label for="periode_mulai" class="form-label">Periode Mulai</label>
    <input id="periode_mulai" type="date" name="periode_mulai"
           class="form-control @error('periode_mulai') is-invalid @enderror"
           value="{{ old('periode_mulai', isset($transaction->periode_mulai) ? \Illuminate\Support\Carbon::parse($transaction->periode_mulai)->format('Y-m-d') : '') }}"
           required>
    @error('periode_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3">
    <label for="periode_selesai" class="form-label">Periode Selesai</label>
    <input id="periode_selesai" type="date" name="periode_selesai"
           class="form-control @error('periode_selesai') is-invalid @enderror"
           value="{{ old('periode_selesai', isset($transaction->periode_selesai) ? \Illuminate\Support\Carbon::parse($transaction->periode_selesai)->format('Y-m-d') : '') }}"
           required>
    @error('periode_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    <small class="text-muted">Harus ≥ Periode Mulai.</small>
  </div>

  {{-- Metode --}}
  <div class="col-md-6">
    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
    <select id="metode_pembayaran" name="metode_pembayaran"
            class="form-select @error('metode_pembayaran') is-invalid @enderror" required>
      @foreach($methods as $val => $label)
        <option value="{{ $val }}" @selected(old('metode_pembayaran', $transaction->metode_pembayaran ?? '') === $val)>
          {{ $label }}
        </option>
      @endforeach
    </select>
    @error('metode_pembayaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
