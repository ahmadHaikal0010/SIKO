<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin • SIKO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Inter', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: black !important;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .logout-btn {
            background-color: #406f6b;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 6px 16px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #254846;
        }

        /* Tombol Kembali di Navbar */
        .landing-btn {
            background-color: #406f6b;
            color: white;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 30px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: 0.3s;
            margin-right: 15px;
        }

        .landing-btn i {
            margin-right: 6px;
            font-size: 1.1rem;
        }

        .landing-btn:hover {
            background-color: #2f5653;
            transform: translateY(-1px);
        }

        /* Dashboard cards */
        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 25px 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 140px;
            text-decoration: none !important;
            color: #333;
            display: block;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background-color: #f9fdfd;
        }

        .dashboard-card i {
            font-size: 2.4rem;
            color: #315e5b;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .dashboard-card:hover i {
            transform: scale(1.15);
            color: #2a4d4b;
        }

        .dashboard-card h6 {
            font-weight: 600;
            font-size: 0.95rem;
            margin-top: 8px;
        }

        /* Custom alert */
        .alert-custom {
            background-color: #315e5b;
            color: #fff;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.9rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Animasi masuk */
        .fade-in {
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- Navbar dengan tombol kembali -->
    <nav class="navbar px-4">
        <div class="d-flex align-items-center">
            <a href="/" class="landing-btn">
                <i class="bi bi-arrow-left-circle"></i> Landing Page
            </a>
            <a class="navbar-brand ms-2" href="/">SIKO Admin</a>
        </div>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <!-- Main -->
    <div class="container my-5 fade-in">
        <h3 class="mb-3 fw-semibold text-dark">Selamat Datang, Admin!</h3>

        <div class="alert-custom mb-4 d-flex align-items-center">
            <i class="bi bi-info-circle me-2 fs-5"></i>
            <span>3 penyewa masa sewanya akan berakhir minggu ini.</span>
        </div>

        <div class="row text-center gy-4">
            <div class="col-md-3 col-6">
                <a href="/admin/galeri" class="dashboard-card">
                    <i class="bi bi-images"></i>
                    <h6>Kelola Galeri Kos</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/informasi" class="dashboard-card">
                    <i class="bi bi-info-circle"></i>
                    <h6>Kelola Informasi Kos</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/kamar" class="dashboard-card">
                    <i class="bi bi-house-door"></i>
                    <h6>Kelola Kamar</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/transaksi" class="dashboard-card">
                    <i class="bi bi-wallet2"></i>
                    <h6>Kelola Transaksi</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/perpanjangan" class="dashboard-card">
                    <i class="bi bi-clock-history"></i>
                    <h6>Perpanjangan Sewa</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/akun" class="dashboard-card">
                    <i class="bi bi-person-lines-fill"></i>
                    <h6>Kelola Akun</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/penghuni" class="dashboard-card">
                    <i class="bi bi-person-badge"></i>
                    <h6>Kelola Penghuni</h6>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="/admin/keluhan" class="dashboard-card">
                    <i class="bi bi-chat-dots"></i>
                    <h6>Status Keluhan</h6>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
