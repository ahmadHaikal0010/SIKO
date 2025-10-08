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
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
            border-radius: 8px;
            padding: 8px 28px;
            font-weight: 600;
            border: none;
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
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: all .3s;
        }
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
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
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Location</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Testimonial</a></li>
                    <li class="nav-item ms-2"><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center gy-4">
        <div class="col-lg-6">
          <span class="badge bg-white text-dark mb-2" style="font-size:1em;">The Best Online Kos in The World!</span>
          <h1 class="hero-title">Kost Eksklusif dengan<br>Fasilitas Paling Lengkap di Padang</h1>
          <p class="hero-desc">
            Temukan pengalaman tinggal yang nyaman dan eksklusif dengan fasilitas modern serta lingkungan yang aman dan strategis.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#" class="btn-primary-custom">Booking Now</a>
            <a href="#" class="btn-outline-custom">View All Kamar</a>
          </div>
        </div>

        <div class="col-lg-6">
          <div id="heroRoomCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <!-- Slide 1 -->
              <div class="carousel-item active">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="room-card">
                      <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                      <div class="room-body">
                        <div class="room-title">Kamar 19 Tipe A</div>
                        <div class="text-muted small">WiFi • Kasur • Dapur • WC dalam kamar</div>
                        <div class="room-price">Rp 14.000.000 / tahun</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="room-card">
                      <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                      <div class="room-body">
                        <div class="room-title">Kamar 07 Tipe B</div>
                        <div class="text-muted small">WiFi • Kasur • Dapur • WC dalam kamar</div>
                        <div class="room-price">Rp 9.000.000 / tahun</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="carousel-item">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="room-card">
                      <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                      <div class="room-body">
                        <div class="room-title">Kamar 02 Tipe C</div>
                        <div class="text-muted small">WiFi • Lemari • AC • Balkon</div>
                        <div class="room-price">Rp 10.500.000 / tahun</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="room-card">
                      <img src="https://images.unsplash.com/photo-1585559604903-4c07aa7d8e22?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                      <div class="room-body">
                        <div class="room-title">Kamar 11 Tipe D</div>
                        <div class="text-muted small">WiFi • AC • Meja Belajar • Dapur</div>
                        <div class="room-price">Rp 12.000.000 / tahun</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="carousel-item">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="room-card">
                      <img src="https://images.unsplash.com/photo-1627308595229-7830a5c91f9f?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                      <div class="room-body">
                        <div class="room-title">Kamar 21 Tipe E</div>
                        <div class="text-muted small">WiFi • TV • Balkon • Dapur Bersama</div>
                        <div class="room-price">Rp 15.000.000 / tahun</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="room-card">
                      <img src="https://images.unsplash.com/photo-1616593962303-5df9d8f51e3c?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                      <div class="room-body">
                        <div class="room-title">Kamar 05 Tipe F</div>
                        <div class="text-muted small">WiFi • Lemari • Kamar Mandi Dalam</div>
                        <div class="room-price">Rp 11.000.000 / tahun</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroRoomCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroRoomCarousel" data-bs-slide="next">
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
            <h3 class="fw-bold">Rooms & Facilities</h3>
            <p class="text-muted">Temukan tipe kamar terbaik sesuai kebutuhan dan budget Anda.</p>
        </div>
        <div class="row gy-4">
            @foreach ([1,2,3] as $i)
            <div class="col-12 col-md-4">
                <div class="room-card">
                    <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=800&q=80" class="room-img" alt="">
                    <div class="room-body">
                        <div class="room-title">Kamar {{ $i }} Tipe A</div>
                        <div class="text-muted small">WiFi • Kasur • Dapur • WC dalam kamar</div>
                        <div class="room-price">Rp 14.000.000 / tahun</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        © 2025 SIKO Kost Eksklusif - All Rights Reserved
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
