<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lokasi Kost - SIKO</title>

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

        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            padding: 16px 0;
        }

        .nav-link {
            color: var(--dark);
            font-weight: 500;
            margin-right: 20px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent);
        }

        .btn-login {
            background: var(--primary);
            color: #fff;
            border-radius: 30px;
            padding: 8px 28px;
            font-weight: 600;
            text-decoration: none;
        }

        .location-header {
            padding: 70px 0 40px;
            text-align: center;
        }

        .location-header h2 {
            font-weight: 700;
        }

        .location-header p {
            color: #666;
        }

        .maps-section {
            padding-bottom: 80px;
        }

        .map-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(0,0,0,.08);
            height: 100%;
        }

        .map-title {
            padding: 14px 18px;
            font-weight: 600;
            background: #e8edeb;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        iframe {
            width: 100%;
            height: 320px;
            border: 0;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">SIKO</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navmenu">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('location') }}" class="nav-link active">Location</a></li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About Us</a></li>
                <li class="nav-item ms-2">
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HEADER -->
<section class="location-header">
    <div class="container">
        <h2>Lokasi Kost</h2>
        <p>
            Berikut adalah lokasi kost yang dapat diakses oleh penghuni.
        </p>
    </div>
</section>

<!-- MAPS -->
<section class="maps-section">
    <div class="container">
        <div class="row g-4">

            <!-- Lokasi 1 -->
            <div class="col-md-4">
                <div class="map-card">
                    <div class="map-title">
                        <i class="bi bi-geo-alt-fill"></i> Lokasi Kost 1
                    </div>
                    <iframe
                        src="https://www.google.com/maps?q=-0.9309776785443078,100.44556377487126&hl=id&z=16&output=embed"
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Lokasi 2 -->
            <div class="col-md-4">
                <div class="map-card">
                    <div class="map-title">
                        <i class="bi bi-geo-alt-fill"></i> Lokasi Kost 2
                    </div>
                    <iframe
                        src="https://www.google.com/maps?q=-0.9318892691388876,100.4303558819548&hl=id&z=16&output=embed"
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Lokasi 3 -->
            <div class="col-md-4">
                <div class="map-card">
                    <div class="map-title">
                        <i class="bi bi-geo-alt-fill"></i> Lokasi Kost 3
                    </div>
                    <iframe
                        src="https://www.google.com/maps?q=-0.9324562926557208,100.4268436464431&hl=id&z=16&output=embed"
                        loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
    <footer class="footer text-light position-relative"
        style="background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;">

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
