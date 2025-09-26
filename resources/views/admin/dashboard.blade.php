<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin • SIKO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f9fc;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            padding: 32px 18px 18px 18px;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            margin-bottom: 12px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.18);
            color: #fff;
        }
        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 32px;
            text-align: center;
        }
        .content {
            padding: 36px 32px;
        }
        .card-stat {
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(31,38,135,0.07);
            border: none;
        }
        .card-stat .card-body {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.7rem;
        }
        @media (max-width: 767px) {
            .sidebar {
                min-height: auto;
                padding: 16px 8px;
            }
            .content {
                padding: 18px 6px;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="logo mb-4">
                <img src="https://img.icons8.com/ios-filled/50/6a11cb/lock-2.png" style="width:36px;height:36px;border-radius:50%;margin-bottom:8px;">
                <div>SIKO Admin</div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manajemen Penghuni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manajemen Kos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Laporan</a>
                </li>
                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link btn btn-link text-start" type="submit" style="color:#fff;">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto col-lg-10 content">
    <h2 class="mb-4 fw-bold" style="color:#185a9d;">Dashboard Admin</h2>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-4">120</div>
                        <div>Penghuni Terdaftar</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-house-door"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-4">3</div>
                        <div>Kos Dikelola</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-4">Rp 25jt</div>
                        <div>Total Transaksi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilihan Kos yang Dikelola -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Pilih Kos yang Ingin Dikelola</h5>
            <div class="row">
                <!-- Kos Mawar Indah -->
                <div class="col-md-4 mb-3">
                    <div class="kost-card p-3 border rounded-3 h-100">
                        <div class="kost-title fw-bold mb-1" style="color:#185a9d;">Kos Mawar Indah</div>
                        <div class="kost-detail mb-1">Jl. Melati No. 10, Dekat Kampus A</div>
                        <div class="kost-detail mb-2">Fasilitas: WiFi, AC, Kamar Mandi Dalam, Parkir</div>
                        <a href="{{ route('admin.kos.manage', ['id' => 1]) }}" class="btn btn-success w-100">Kelola Kos Ini</a>
                    </div>
                </div>
                <!-- Kos Anggrek Asri -->
                <div class="col-md-4 mb-3">
                    <div class="kost-card p-3 border rounded-3 h-100">
                        <div class="kost-title fw-bold mb-1" style="color:#185a9d;">Kos Anggrek Asri</div>
                        <div class="kost-detail mb-1">Jl. Kenanga No. 5, Dekat Kampus B</div>
                        <div class="kost-detail mb-2">Fasilitas: WiFi, Kipas Angin, Dapur Bersama</div>
                        <a href="{{ route('admin.kos.manage', ['id' => 2]) }}" class="btn btn-success w-100">Kelola Kos Ini</a>
                    </div>
                </div>
                <!-- Kos Melati Putih -->
                <div class="col-md-4 mb-3">
                    <div class="kost-card p-3 border rounded-3 h-100">
                        <div class="kost-title fw-bold mb-1" style="color:#185a9d;">Kos Melati Putih</div>
                        <div class="kost-detail mb-1">Jl. Dahlia No. 12, Dekat Pusat Kota</div>
                        <div class="kost-detail mb-2">Fasilitas: WiFi, AC, Laundry, Keamanan 24 Jam</div>
                        <a href="{{ route('admin.kos.manage', ['id' => 3]) }}" class="btn btn-success w-100">Kelola Kos Ini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Selamat datang, Admin!</h5>
            <p>
                Anda dapat mengelola data penghuni, kos, transaksi, dan melihat laporan melalui dashboard ini.<br>
                Silakan pilih menu di sebelah kiri untuk memulai.
            </p>
        </div>
    </div>
</main>
    </div>
</div>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
