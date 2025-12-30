@php
  /** @var \App\Models\User|null $authUser */ $authUser = auth()->user();
  $genders  = ['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan'];
  $jobs     = ['pelajar' => 'Pelajar', 'karyawan' => 'Karyawan', 'wirausaha' => 'Wirausaha', 'lainnya' => 'Lainnya'];
  $statuses = ['active' => 'Aktif', 'inactive' => 'Nonaktif'];

  $tenant = $tenant ?? $authUser->tenant ?? null;
@endphp

<div class="row g-3">

  {{-- user_id hidden (current user) --}}
  <input type="hidden" name="user_id" value="{{ auth()->id() }}">

  {{-- ROOM --}}
  <div class="col-md-6">
    <label for="room_id" class="form-label">Kamar</label>
    <select id="room_id" name="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
      <option value="">— Pilih Kamar —</option>
      @foreach ($rooms->groupBy(fn($r) => $r->kost?->nama_kost ?? 'Tanpa Kost') as $kostName => $roomList)
        <optgroup label="{{ $kostName }}">
          @foreach ($roomList as $r)
            @php
              $selected = old('room_id', $tenant->room_id ?? null) == $r->id;
              $isTaken  = $r->status !== 'available' && !$selected;
            @endphp
            <option value="{{ $r->id }}" @selected($selected) @disabled($isTaken)>
              {{ $r->nomor_kamar }} — {{ $r->status === 'available' ? 'Tersedia' : 'Terisi' }}
            </option>
          @endforeach
        </optgroup>
      @endforeach
    </select>
    <small class="text-muted">Pilih kamar yang tersedia; jika ingin pindah kamar ke lain waktu, gunakan menu Ubah Data Penghuni.</small>
    @error('room_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- NAMA --}}
  <div class="col-md-6">
    <label for="nama_penghuni" class="form-label">Nama Penghuni</label>
    <input id="nama_penghuni" type="text" name="nama_penghuni"
           class="form-control @error('nama_penghuni') is-invalid @enderror"
           value="{{ old('nama_penghuni', $tenant->nama_penghuni ?? $authUser->name ?? '') }}" required>"
    @error('nama_penghuni') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- GENDER --}}
  <div class="col-md-3">
    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
      <option value="">— Pilih —</option>
      @foreach ($genders as $val => $label)
        <option value="{{ $val }}" @selected(old('jenis_kelamin', $tenant->jenis_kelamin ?? '') === $val)>
          {{ $label }}
        </option>
      @endforeach
    </select>
    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- STATUS --}}
  <div class="col-md-3">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
      @foreach ($statuses as $val => $label)
        <option value="{{ $val }}" @selected(old('status', $tenant->status ?? 'active') === $val)>
          {{ $label }}
        </option>
      @endforeach
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- TELPON --}}
  <div class="col-md-6">
    <label for="telpon" class="form-label">Telpon Penghuni</label>
    <input id="telpon" type="tel" name="telpon"
           class="form-control @error('telpon') is-invalid @enderror"
           value="{{ old('telpon', $tenant->telpon ?? $authUser->phone ?? '') }}"
           placeholder="08xxxxxxxxxx" pattern="[0-9 +()\-]{6,20}">
    @error('telpon') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- PEKERJAAN --}}
  <div class="col-md-6">
    <label for="pekerjaan" class="form-label">Pekerjaan</label>
    <select id="pekerjaan" name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
      <option value="">— Pilih Pekerjaan —</option>
      @foreach ($jobs as $val => $label)
        <option value="{{ $val }}" @selected(old('pekerjaan', $tenant->pekerjaan ?? '') === $val)>
          {{ $label }}
        </option>
      @endforeach
    </select>
    @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- NAMA WALI --}}
  <div class="col-md-6">
    <label for="nama_wali" class="form-label">Nama Wali</label>
    <input id="nama_wali" type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" value="{{ old('nama_wali', $tenant->nama_wali ?? '') }}">
    @error('nama_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- TELPON WALI --}}
  <div class="col-md-6">
    <label for="telpon_wali" class="form-label">Telpon Wali</label>
    <input id="telpon_wali" type="tel" name="telpon_wali" class="form-control @error('telpon_wali') is-invalid @enderror" value="{{ old('telpon_wali', $tenant->telpon_wali ?? '') }}" pattern="[0-9 +()\-]{6,20}">
    @error('telpon_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- TANGGAL MASUK --}}
  <div class="col-md-6">
    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
    <input id="tanggal_masuk" type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', isset($tenant->tanggal_masuk) ? \Illuminate\Support\Carbon::parse($tenant->tanggal_masuk)->format('Y-m-d') : '') }}" required>
    @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- TANGGAL KELUAR --}}
  <div class="col-md-6">
    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
    <input id="tanggal_keluar" type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" value="{{ old('tanggal_keluar', isset($tenant->tanggal_keluar) ? \Illuminate\Support\Carbon::parse($tenant->tanggal_keluar)->format('Y-m-d') : '') }}">
    <small class="text-muted">Boleh kosong; jika diisi harus ≥ tanggal masuk.</small>
    @error('tanggal_keluar') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

</div>
