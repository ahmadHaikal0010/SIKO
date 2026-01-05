<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKO - Kost Eksklusif di Padang</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #315e5b;
            --accent: #406f6b;
            --light-gray: #f3f4f6;
            --dark: #1a1a1a;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-gray);
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            position: relative;
            z-index: 1030;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 16px 0;
        }

        .nav-link {
            color: var(--dark);
            font-weight: 500;
            margin-right: 20px;
            transition: color .2s;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .btn-login {
            background: var(--primary);
            color: #fff;
            border-radius: 30px;
            padding: 8px 28px;
            font-weight: 600;
            border: none;
            text-decoration: none;
        }

        .btn-login:hover {
            background: var(--accent);
            color: #fff;
        }

        /* Hero */
        .hero-section {
            background: #e8edeb;
            padding: 80px 0;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .hero-desc {
            font-size: 1.05rem;
            color: #555;
            margin-top: 12px;
            margin-bottom: 28px;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            padding: 10px 28px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: all .2s;
        }

        .btn-primary-custom:hover {
            background: var(--accent);
            color: #fff;
        }

        .btn-outline-custom {
            border: 1.5px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 8px;
            transition: all .2s;
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: #fff;
        }

        /* Room Cards */
        .room-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all .3s;
        }

        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Ensure carousel positions correctly and controls are always clickable */
        #heroRoomCarousel{ position: relative; }
        .carousel-control-prev,
        .carousel-control-next{
            width:44px;
            height:44px;
            background: rgba(0,0,0,0.35);
            border-radius:50%;
            top:50%;
            transform: translateY(-50%);
            display:flex;
            align-items:center;
            justify-content:center;
            z-index:6;
            pointer-events:auto;
            border:none;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon{
            filter: invert(1);
            width:18px;height:18px;
            background-size:100% 100%;
        }

        .room-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .room-body {
            padding: 16px;
        }

        .room-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .room-price {
            color: var(--primary);
            font-weight: 700;
            margin-top: 6px;
        }

        /* Facilities */
        .facilities-section {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            padding: 40px 0;
            margin-top: 60px;
        }

        .facility-icon {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .facility-title {
            font-weight: 600;
            color: var(--dark);
        }

        /* Footer */
        .footer {
            background: #fff;
            padding: 24px 0;
            text-align: center;
            color: #777;
            margin-top: 60px;
        }

        @media (max-width: 767px) {
            .hero-title {
                font-size: 1.6rem;
            }

            .room-img {
                height: 160px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SIKO</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navmenu">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('location') }}" class="nav-link active">Location</a></li>
                    <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About Us</a></li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item ms-2"><a href="{{ route('admin.dashboard') }}" class="btn-login">Dashboard</a></li>
                        @elseif(in_array(auth()->user()->role, ['penghuni','tenant','user']))
                            <li class="nav-item ms-2"><a href="{{ route('tenant.dashboard') }}" class="btn-login">Dashboard</a></li>
                        @else
                            <li class="nav-item ms-2"><a href="{{ url('/') }}" class="btn-login">Dashboard</a></li>
                        @endif
                    @else
                        <li class="nav-item ms-2"><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

   <!-- Hero Section with Carousel -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <span class="badge bg-white text-dark mb-2" style="font-size:1em;">The Best Online Kos in The
                    World!</span>
                <h1 class="hero-title">Kost Eksklusif dengan<br>Fasilitas Paling Lengkap di Padang</h1>
                <p class="hero-desc">
                    Temukan pengalaman tinggal yang nyaman dan eksklusif dengan fasilitas modern serta lingkungan
                    yang aman dan strategis.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#" class="btn-primary-custom">Booking Now</a>
                    <a href="#" class="btn-outline-custom">View All Kamar</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div id="heroRoomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            // Ambil galeri dari kost pertama atau semua kost
                            $allGalleries = \App\Models\Gallery::limit(20)->get();
                            $chunked = $allGalleries->chunk(2); // Bagi 2 foto per slide
                        @endphp

                        @forelse ($chunked as $index => $pair)
                            <div class="carousel-item @if($index === 0) active @endif">
                                <div class="row g-3">
                                    @foreach ($pair as $gallery)
                                        <div class="col-md-6">
                                            <div class="room-card">
                                                <img src="{{ $gallery->image_url }}"
                                                     class="room-img"
                                                     alt="{{ $gallery->title ?? 'Galeri' }}"
                                                     style="object-fit: cover;">
                                                @isset($gallery->title)
                                                    <div class="room-body">
                                                        <div class="room-title">{{ $gallery->title }}</div>
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            {{-- Fallback jika tidak ada galeri --}}
                            <div class="carousel-item active">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="room-card">
                                            <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=800&q=80"
                                                class="room-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="room-card">
                                            <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80"
                                                class="room-img" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Carousel controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroRoomCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroRoomCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Facilities -->
    <section class="facilities-section container">
        <div class="row text-center justify-content-center">
            <div class="col-12 col-md-4">
                <i class="bi bi-wifi facility-icon"></i>
                <div class="facility-title">WiFi Cepat</div>
                <p class="text-muted small">Nikmati internet cepat di seluruh area kos.</p>
            </div>
            <div class="col-12 col-md-4">
                <i class="bi bi-cup-hot facility-icon"></i>
                <div class="facility-title">Dapur Bersih</div>
                <p class="text-muted small">Fasilitas dapur lengkap untuk kebutuhan harian Anda.</p>
            </div>
            <div class="col-12 col-md-4">
                <i class="bi bi-house-door facility-icon"></i>
                <div class="facility-title">Kamar Nyaman</div>
                <p class="text-muted small">Desain kamar minimalis dan bersih untuk kenyamanan maksimal.</p>
            </div>
        </div>
    </section>

    <!-- Rooms -->
    <section class="container mt-5">
    <div class="text-center mb-4">
        <h3 class="fw-bold">KOS Mitra</h3>
        <p class="text-muted">Temukan tempat kos terbaik dan terdekatmu </p>
    </div>

    <div class="row gy-4">
        @foreach ($kosts as $k)
        <div class="col-12 col-md-4">
            <a href="{{ route('kost.show', $k->id) }}" class="text-decoration-none text-dark">
            <div class="room-card">
                <img src="{{ $k->cover_url }}" class="room-img" alt="Cover {{ $k->nama_kost }}">
                <div class="room-body">
                <div class="room-title">{{ $k->nama_kost }}</div>
                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($k->alamat ?? '-', 60) }}</div>
                @if(!empty($k->harga_kost))
                    <div class="room-price">Rp {{ number_format($k->harga_kost,0,',','.') }} / tahun</div>
                @endif
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    </section>


    <!-- Footer -->
    <footer class="footer text-light position-relative"
        style="background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;">

        <!-- Overlay gradasi sesuai warna khas SIKO -->
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(135deg, rgba(49,94,91,0.92), rgba(64,111,107,0.9));"></div>

        <div class="container py-5 position-relative">
            <div class="row text-center text-md-start gy-4 align-items-start">

                <!-- Brand -->
                <div class="col-md-4">
                    <h5 class="fw-bold text-white mb-3">SIKO Kost Eksklusif</h5>
                    <p class="small text-light mb-0 opacity-85">
                        Hunian modern dan nyaman di Padang dengan fasilitas lengkap serta lingkungan aman dan strategis.
                    </p>
                </div>

                <!-- Kontak -->
                <div class="col-md-4">
                    <h6 class="fw-semibold text-white mb-3">Hubungi Kami</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="https://wa.me/6282183539946" target="_blank"
                            class="text-decoration-none text-light d-flex align-items-center gap-2 opacity-85 hover-bright">
                            <i class="bi bi-whatsapp fs-5 text-success"></i> WhatsApp
                        </a>
                        <a href="https://instagram.com/_fadhiiilll" target="_blank"
                            class="text-decoration-none text-light d-flex align-items-center gap-2 opacity-85 hover-bright">
                            <i class="bi bi-instagram fs-5 text-danger"></i> Instagram
                        </a>
                        <a href="mailto:siko@example.com"
                            class="text-decoration-none text-light d-flex align-items-center gap-2 opacity-85 hover-bright">
                            <i class="bi bi-envelope fs-5 text-warning"></i> Email
                        </a>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="col-md-4">
                    <h6 class="fw-semibold text-white mb-3">Alamat</h6>
                    <p class="small mb-1 text-light opacity-85">Jl. Mawar No. 12, Padang</p>
                    <p class="small mb-1 text-light opacity-85">Dekat Universitas Andalas</p>
                    <p class="small mb-0 text-light opacity-85">Buka setiap hari 08.00 – 21.00</p>
                </div>
            </div>

            <hr class="border-light my-4 opacity-25">

            <!-- Copyright -->
            <div class="text-center">
                <p class="small mb-0 text-light opacity-75">
                    &copy; {{ date('Y') }} <strong>SIKO</strong> • Kost Eksklusif di Padang • Dibuat dengan
                    <i class="bi bi-heart-fill text-danger"></i> oleh Tim SIKO
                </p>
            </div>
        </div>
    </footer>

    <style>
        /* Tambahan gaya kecil untuk efek hover yang lembut */
        .hover-bright:hover {
            opacity: 1 !important;
            transform: translateX(4px);
            transition: all .3s ease;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
