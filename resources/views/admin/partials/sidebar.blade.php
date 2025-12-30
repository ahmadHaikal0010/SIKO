@php
  // helper active
  $active = fn ($pattern) => request()->routeIs($pattern) ? 'is-active' : '';
@endphp

<aside class="siko-sidebar d-none d-md-flex flex-column">
  <nav class="siko-menu flex-grow-1">

    <a style="--i:1" href="{{ route('admin.dashboard') }}" class="side-item {{ $active('admin.dashboard') }}">
      <i class="bi bi-speedometer2 side-ic"></i><span>Dashboard</span>
    </a>

    <a style="--i:2" href="{{ route('admin.kost.index') }}" class="side-item {{ $active('admin.kost.*') }}">
      <i class="bi bi-info-circle side-ic"></i><span>Kelola Informasi Kost</span>
    </a>

    <a style="--i:3" href="{{ route('admin.room.index') }}" class="side-item {{ $active('admin.room.*') }}">
      <i class="bi bi-building side-ic"></i><span>Kelola Kamar</span>
    </a>

    <a style="--i:4" href="{{ route('admin.tenant.index') }}" class="side-item {{ $active('admin.tenant.*') }}">
      <i class="bi bi-people side-ic"></i><span>Kelola Penghuni</span>
    </a>

    <a style="--i:5" href="{{ route('admin.gallery.index') }}" class="side-item {{ $active('admin.gallery.*') }}">
      <i class="bi bi-images side-ic"></i><span>Kelola Galeri Kost</span>
    </a>

    <a style="--i:6" href="{{ route('admin.rental_extension.index') }}" class="side-item {{ $active('admin.rental_extension.*') }}">
      <i class="bi bi-arrow-repeat side-ic"></i><span>Perpanjangan Sewa</span>
    </a>

    {{-- Akun Penghuni (admin) --}}
    <a style="--i:7" href="{{ route('admin.account.index') }}" class="side-item {{ $active('admin.account.*') }}">
      <i class="bi bi-person-lines-fill side-ic"></i><span>Kelola Akun Penghuni</span>
    </a>

    <a style="--i:8" href="{{ route('admin.complaint.index') }}" class="side-item {{ $active('admin.complaint.*') }}">
      <i class="bi bi-chat-dots side-ic"></i><span>Kelola Keluhan</span>
    </a>

    <a style="--i:8" href="{{ route('admin.transaction.index') }}" class="side-item {{ $active('admin.transaction.*') }}">
      <i class="bi bi-cash-coin side-ic"></i><span>Kelola Transaksi</span>
    </a>
  </nav>

  <div class="siko-logout">
    <form action="{{ route('logout') }}" method="POST" class="m-0">
      @csrf
      <button type="submit" class="side-item side-logout" style="--i:9">
        <i class="bi bi-box-arrow-right side-ic"></i><span>Log out</span>
      </button>
    </form>
  </div>
</aside>
