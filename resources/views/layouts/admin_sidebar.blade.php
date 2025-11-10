<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title','Admin • SIKO')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* ====== BASE THEME (tetap) ====== */
    body{ background:#F6EFEE; font-family:'Inter',sans-serif; }
    .topbar{ height:64px; background:#fff; border-bottom:1px solid #e5e7eb; }

    /* ====== SIDEBAR THEME ====== */
    :root{
      --sd-bg:#214D48;         /* hijau sidebar */
      --sd-text:#EAF2F1;       /* teks sidebar */
      --sd-text-dim:#C9DFDC;   /* ikon/teks redup */
      --sd-active:#D8B4B4;     /* highlight aktif (pink lembut) */
      --sd-hover:rgba(255,255,255,.10);
      --sd-accent:#96C5BE;     /* glow tipis ikon */
    }

    /* Sidebar container + animasi masuk */
    .siko-sidebar{
      width:280px; background:var(--sd-bg);
      min-height:calc(100vh - 64px);
      padding:18px 14px; border-right:1px solid rgba(0,0,0,.06);
      animation:sidebarIn .5s ease both;
    }
    @keyframes sidebarIn{ from{opacity:0; transform:translateX(-8px)} to{opacity:1; transform:translateX(0)} }

    .siko-menu{ display:flex; flex-direction:column; gap:6px; }

    /* Item + animasi stagger */
    .side-item{
      position:relative;
      display:flex; align-items:center; gap:12px;
      color:var(--sd-text); text-decoration:none;
      padding:12px 14px; border-radius:10px; font-weight:500;
      transition: background .18s ease, transform .12s ease, box-shadow .18s ease;
      opacity:0; transform:translateY(6px);
      animation:itemIn .45s ease forwards;
      animation-delay: calc(var(--i, 0) * 70ms);
      overflow:hidden;  /* untuk ripple */
    }
    @keyframes itemIn{ to{opacity:1; transform:translateY(0)} }

    .side-item .side-ic{
      font-size:1.15rem; color:var(--sd-text-dim);
      transition: transform .15s ease, color .15s ease, text-shadow .2s ease;
      text-shadow:0 0 0 transparent;
    }
    .side-item:hover{ background:var(--sd-hover); transform:translateX(2px) }
    .side-item:hover .side-ic{ transform:scale(1.08); color:#fff; text-shadow:0 0 10px var(--sd-accent) }

    /* Aktif: blok pink + marker kiri */
    .side-item.is-active{ background:var(--sd-active); color:#1E1E1E; box-shadow:0 2px 8px rgba(0,0,0,.08) }
    .side-item.is-active .side-ic{ color:#6F3E3E; text-shadow:none }
    .side-item.is-active::before{
      content:""; position:absolute; left:6px; top:10px; bottom:10px;
      width:4px; border-radius:4px; background:#F3D2D2;
    }

    /* Ripple klik */
    .side-item::after{
      content:""; position:absolute; inset:0; border-radius:10px;
      background:radial-gradient(120px 120px at var(--rx,50%) var(--ry,50%), rgba(255,255,255,.22), transparent 55%);
      opacity:0; transition:opacity .35s ease;
      pointer-events:none;
    }
    .side-item:active::after{ opacity:1 }

    /* Logout block */
    .siko-logout{ margin-top:8px; border-top:1px solid rgba(255,255,255,.12); padding-top:12px }
    .side-logout{ background:transparent; border:0; text-align:left; width:100% }

    /* Responsive: sembunyikan di md- */
    @media (max-width: 991.98px){ .siko-sidebar{ display:none!important } }
  </style>

  @stack('styles')
</head>
<body>
  {{-- Topbar --}}
  <div class="topbar d-flex align-items-center justify-content-between px-4">
    <div class="fw-semibold">SIKO</div>
    <div class="d-flex align-items-center gap-2">
      <span class="text-muted">Owner</span>
      <div class="rounded-circle d-flex align-items-center justify-content-center"
           style="width:40px;height:40px;background:#214D48;color:#fff">👤</div>
    </div>
  </div>

  <div class="d-flex">
    {{-- Sidebar kiri --}}
    @include('admin.partials.sidebar')

    {{-- Konten kanan --}}
    <main class="flex-grow-1 p-4">
      @yield('content')
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  {{-- JS kecil untuk ripple mengikuti posisi klik --}}
  <script>
    document.addEventListener('pointerdown', (e)=>{
      const a = e.target.closest('.side-item');
      if(!a) return;
      const r = a.getBoundingClientRect();
      a.style.setProperty('--rx', ((e.clientX - r.left) / r.width * 100) + '%');
      a.style.setProperty('--ry', ((e.clientY - r.top) / r.height * 100) + '%');
    }, true);
  </script>

  @stack('scripts')
</body>
</html>
