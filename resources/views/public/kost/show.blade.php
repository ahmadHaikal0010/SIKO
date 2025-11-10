<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $kost->nama_kost }} • SIKO</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  @php
    // Main image = foto galeri pertama; fallback ke cover; terakhir placeholder
    $firstGallery = $kost->galleries->first();
    $mainImage    = $firstGallery?->image_url
                    ?? ($kost->cover_url ?? 'https://via.placeholder.com/1200x700?text=Kost');

    // Hitung kamar tersedia
    $availableRooms = $kost->rooms->where('status','available')->count();

    // Parsikan fasilitas (dipisah koma atau baris)
    $facilities = collect(preg_split("/\r\n|\n|\r|,/", (string) $kost->fasilitas))
                    ->map(fn($v)=>trim($v))
                    ->filter()
                    ->values();
  @endphp

  <style>
    body{background:#f6f7fb;font-family:'Poppins',sans-serif;}
    .navbar{background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.05)}
    .nav-link{color:#1e293b!important;font-weight:500}
    .nav-link:hover{color:#2563eb!important}
    .btn-login{background:#315e5b;border:none;color:#fff;font-weight:600;border-radius:10px;padding:8px 22px}
    .btn-login:hover{background:#234643;color:#fff}

    .hero{border-radius:16px;overflow:hidden;background:#e5eef0}
    .hero img{width:100%;height:480px;object-fit:cover}
    .thumbs{display:flex;gap:10px;overflow:auto;margin-top:12px;padding-bottom:6px}
    .thumbs img{width:110px;height:110px;object-fit:cover;border-radius:10px;border:3px solid transparent;cursor:pointer;transition:.15s}
    .thumbs img:hover,.thumbs img.active{border-color:#315e5b;box-shadow:0 6px 18px rgba(33,77,72,.15)}

    .price-card{background:linear-gradient(135deg,#315e5b,#406f6b);color:#fff;border-radius:16px;padding:22px}
    .price-lg{font-size:2.1rem;font-weight:800}
    .chip{display:inline-flex;align-items:center;gap:8px;background:#f1f5f9;border-radius:999px;padding:8px 14px;font-weight:600;color:#0f172a}
    .chip i{color:#315e5b}

    .section-title{font-size:1.4rem;font-weight:800;color:#0f172a;margin:22px 0 14px}
    .card-soft{background:#fff;border:0;border-radius:16px;box-shadow:0 8px 26px rgba(2,6,23,.06)}
    .facility-badge{background:#eef2f7;border-radius:10px;padding:10px 12px;font-weight:600}
    .facility-badge i{color:#315e5b;margin-right:8px}

    .room{overflow:hidden;border-radius:16px;background:#fff;box-shadow:0 8px 26px rgba(2,6,23,.06);transition:.2s}
    .room:hover{transform:translateY(-4px);box-shadow:0 14px 30px rgba(2,6,23,.09)}
    .room img{width:100%;height:190px;object-fit:cover}
    .badge-available{background:#10b981}
    .badge-occupied{background:#f43f5e}

    .contact{background:linear-gradient(135deg,#315e5b,#406f6b);color:#fff;border-radius:16px}
    .btn-ghost{background:#fff;color:#315e5b;font-weight:700;border:none;border-radius:10px;padding:12px 18px}
    .btn-ghost:hover{background:#f1f5f9}
    @media (max-width: 992px){
      .hero img{height:320px}
      .thumbs img{width:88px;height:88px}
    }
  </style>
</head>
<body>

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg px-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/">SIKO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="nav" class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/#location">Location</a></li>
          <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
          @guest
            <li class="nav-item ms-2"><a href="{{ route('login') }}" class="btn-login">Login</a></li>
          @else
            <li class="nav-item ms-2"><a href="{{ route('admin.dashboard') }}" class="btn-login">Dashboard</a></li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="container my-5">

    <div class="row g-4">
      {{-- Galeri --}}
      <div class="col-lg-8">
        <div class="hero card-soft">
          <img id="mainImage" src="{{ $mainImage }}" alt="{{ $kost->nama_kost }}" data-bs-toggle="modal" data-bs-target="#lightbox">
        </div>

        @if($kost->galleries->count() > 0)
          <div class="thumbs">
            @foreach($kost->galleries as $g)
              <img
                src="{{ $g->image_url }}"
                alt="Foto {{ $kost->nama_kost }}"
                class="@if($loop->first) active @endif"
                onclick="changeMainImage(this)">
            @endforeach
          </div>
        @endif
      </div>

      {{-- Harga & info singkat --}}
      <div class="col-lg-4">
        <div class="price-card mb-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="fw-semibold opacity-75">Harga per tahun</span>
            <span class="chip"><i class="bi bi-geo-alt"></i>{{ $kost->alamat ?: 'Padang' }}</span>
          </div>
          <div class="price-lg">Rp {{ number_format($kost->harga_kost ?? 0, 0, ',', '.') }}</div>
          <div class="d-grid mt-3">
            <a href="https://wa.me/6282183539946" target="_blank" class="btn btn-ghost">
              <i class="bi bi-calendar-check me-2"></i> Booking Sekarang
            </a>
          </div>
        </div>

        <div class="card-soft p-3">
          <div class="d-flex flex-column gap-2">
            <div class="facility-badge"><i class="bi bi-buildings"></i> {{ $availableRooms }} Kamar Tersedia</div>
            <div class="facility-badge"><i class="bi bi-people"></i> Kategori: <strong>{{ $kost->kategori ?? '-' }}</strong></div>
          </div>
        </div>
      </div>
    </div>

    {{-- Judul & Deskripsi --}}
    <div class="row g-4 mt-2">
      <div class="col-lg-8">
        <h1 class="mt-2 mb-1">{{ $kost->nama_kost }}</h1>
        <div class="text-muted mb-3">{{ $kost->alamat ?? '-' }}</div>

        @if(!empty($kost->deskripsi))
          <div class="card-soft p-4">
            <div class="section-title">Tentang Kost</div>
            <p class="mb-0" style="line-height:1.8">{{ $kost->deskripsi }}</p>
          </div>
        @endif

        {{-- Galeri (grid) --}}
        @if($kost->galleries->count() > 1)
          <div class="card-soft p-4 mt-4">
            <div class="section-title">Galeri Foto</div>
            <div class="row g-3">
              @foreach($kost->galleries as $g)
                <div class="col-6 col-md-4">
                  <a href="#" onclick="openFromThumb('{{ $g->image_url }}');return false;">
                    <img src="{{ $g->image_url }}" class="w-100 rounded-3" style="height:160px;object-fit:cover" alt="">
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>

      {{-- Fasilitas --}}
      <div class="col-lg-4">
        <div class="card-soft p-4 h-100">
          <div class="section-title">Fasilitas</div>
          @if($facilities->isNotEmpty())
            <div class="d-flex flex-column gap-2">
              @foreach($facilities as $f)
                <div class="facility-badge"><i class="bi bi-check2-circle"></i> {{ $f }}</div>
              @endforeach
            </div>
          @else
            <div class="text-muted">Belum ada data fasilitas.</div>
          @endif
        </div>
      </div>
    </div>

    {{-- Kamar Tersedia --}}
    <div class="section-title mt-5">Kamar</div>
    @if($kost->rooms->count())
      <div class="row g-4">
        @foreach($kost->rooms as $room)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="room">
              <img src="{{ $firstGallery?->image_url ?? $kost->cover_url ?? 'https://via.placeholder.com/600x400?text=Room' }}" alt="">
              <div class="p-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="fw-bold">Kamar {{ $room->nomor_kamar }}</div>
                  @if($room->status === 'available')
                    <span class="badge badge-available">Tersedia</span>
                  @else
                    <span class="badge badge-occupied">Terisi</span>
                  @endif
                </div>
                <div class="text-muted small mt-1">Harga: Rp {{ number_format($kost->harga_kost ?? 0, 0, ',', '.') }}/tahun</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted">Belum ada data kamar.</div>
    @endif

    {{-- Kontak --}}
    <div class="contact p-4 mt-5 text-center" id="contact">
      <h3 class="fw-bold mb-2">Tertarik? Hubungi Kami</h3>
      <p class="mb-3">Dapatkan info lebih lengkap mengenai ketersediaan kamar dan proses booking.</p>
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <a href="https://wa.me/6282183539946" target="_blank" class="btn-ghost"><i class="bi bi-whatsapp me-2"></i> WhatsApp</a>
        <a href="tel:08123456789" class="btn-ghost"><i class="bi bi-telephone me-2"></i> Telepon</a>
        <a href="https://instagram.com/siko.fadhiiilll" target="_blank" class="btn-ghost"><i class="bi bi-instagram me-2"></i> Instagram</a>
      </div>
    </div>

  </main>

  <footer class="py-4 text-center text-muted">© {{ date('Y') }} SIKO • Kost Eksklusif di Padang</footer>

  {{-- Lightbox Modal --}}
  <div class="modal fade" id="lightbox" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content bg-transparent border-0">
        <button type="button" class="btn-close ms-auto me-2 mt-2" data-bs-dismiss="modal"></button>
        <img id="lightboxImg" src="{{ $mainImage }}" class="w-100 rounded-4 shadow" style="max-height:80vh;object-fit:contain">
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function changeMainImage(el){
      const main = document.getElementById('mainImage');
      document.querySelectorAll('.thumbs img').forEach(i=>i.classList.remove('active'));
      el.classList.add('active');
      main.src = el.src;
      // update lightbox
      document.getElementById('lightboxImg').src = el.src;
    }
    function openFromThumb(src){
      document.getElementById('mainImage').src = src;
      document.getElementById('lightboxImg').src = src;
      const m = new bootstrap.Modal('#lightbox');
      m.show();
    }
    // klik mainImage -> lightbox
    document.getElementById('mainImage')?.addEventListener('click', function(){
      document.getElementById('lightboxImg').src = this.src;
    });
  </script>
</body>
</html>
