<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - SIKO</title>

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

        .nav-link:hover {
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

        .about-section {
            padding: 80px 0;
        }

        .about-badge {
            background: #e8edeb;
            color: var(--primary);
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: .85rem;
            display: inline-block;
            margin-bottom: 14px;
        }

        .about-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .about-desc {
            color: #555;
            line-height: 1.7;
        }

        .about-img {
            border-radius: 20px;
            width: 100%;
            height: 360px;
            object-fit: cover;
            box-shadow: 0 8px 24px rgba(0,0,0,.12);
        }

.steps-section {
    background: #f4f8f3;
    padding: 80px 0;
}

.step-card {
    background: #fff;
    border-radius: 16px;
    padding: 28px 22px;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,.06);
    height: 100%;
}

.step-icon {
    width: 48px;
    height: 48px;
    background: #e8edeb;
    color: var(--primary);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 14px;
}

.step-title {
    font-weight: 600;
    margin-bottom: 6px;
}

.step-desc {
    font-size: .9rem;
    color: #666;
}

/* CTA Section */
.cta-section {
    background: var(--primary);
    color: #fff;
    padding: 70px 0;
    text-align: center;
}

.cta-section p {
    color: #e6f0ee;
}

.btn-cta {
    background: #fff;
    color: var(--primary);
    padding: 12px 32px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
}

.btn-cta:hover {
    background: #f1f1f1;
}

        .footer {
            background: #fff;
            padding: 24px 0;
            text-align: center;
            color: #777;
            margin-top: 0px;
        }

        @media (max-width: 768px) {
            .about-img {
                height: 260px;
            }
        }
    </style>
</head>

<body>

<!-- Navbar -->
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
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link active">About Us</a></li>
                <li class="nav-item ms-2">
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ABOUT US -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center gy-5">

            <!-- TEXT -->
            <div class="col-lg-6">
                <span class="about-badge">About SIKO</span>
                <h2 class="about-title">
                    Solusi Kost Modern & Eksklusif di Kota Padang
                </h2>
                    <p class="about-desc">
                    <strong>SIKO</strong> adalah website resmi pengelolaan kost yang dibuat
                    untuk memudahkan penghuni dalam mengakses informasi, layanan, dan
                    administrasi kos secara terpusat.
                </p>
                <p class="about-desc">
                Website ini digunakan secara internal oleh penghuni kos SIKO,
                sehingga setiap akun yang mendaftar akan melalui proses konfirmasi
                terlebih dahulu oleh pemilik kos sebelum dapat menggunakan layanan
                yang tersedia.
                </p>
            </div>

            <!-- IMAGE -->
            <div class="col-lg-6 text-center">
                <img
                    src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80"
                    alt="About SIKO"
                    class="about-img">
            </div>

        </div>
    </div>
</section>

<!-- STEPS -->
<section class="steps-section">
    <div class="container">
        <h3 class="text-center fw-bold mb-5">
            Cara Mendaftar Kost
        </h3>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h6 class="step-title">1. Daftar Akun</h6>
                    <p class="step-desc">
                        Buat akun penghuni dengan mengisi data dasar melalui halaman pendaftaran.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h6 class="step-title">2. Konfirmasi Pemilik Kos</h6>
<p class="step-desc">
    Akun yang telah didaftarkan akan diverifikasi terlebih dahulu oleh
    pemilik kos sebelum mendapatkan akses ke layanan website.
</p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>
                    <h6 class="step-title">3. Lengkapi Data Diri</h6>
<p class="step-desc">
    Setelah akun dikonfirmasi, penghuni dapat melengkapi data diri dan
    mulai menggunakan layanan yang tersedia di website kos.
</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h3 class="fw-bold mb-2">
    Ingin Menjadi Penghuni Kost SIKO?
</h3>
<p>
    Silakan lakukan pendaftaran akun dan tunggu konfirmasi dari pemilik kos.
</p>

<a href="{{ route('register') }}" class="btn-cta">
    Daftar Akun Penghuni
</a>

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
