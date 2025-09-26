<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Landing Page • SIKO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            font-family: 'Poppins', sans-serif;
            color: #222;
        }
        .landing-content {
            background: rgba(255,255,255,0.7);
            border-radius: 24px;
            padding: 48px 36px 36px 36px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.10);
            margin: 48px auto;
            max-width: 1000px;
            position: relative;
        }
        .landing-content::before {
            content: '';
            position: absolute;
            top: -40px; left: -40px;
            width: 120px; height: 120px;
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            opacity: 0.15;
            border-radius: 50%;
            z-index: 0;
        }
        .landing-content::after {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 120px; height: 120px;
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            opacity: 0.12;
            border-radius: 50%;
            z-index: 0;
        }
        .main-title {
            font-weight: 800;
            font-size: 2.3rem;
            color: #185a9d;
            letter-spacing: 1px;
        }
        .subtitle {
            color: #43cea2;
            font-weight: 600;
            font-size: 1.2rem;
        }
        .btn-main {
            background: linear-gradient(90deg, #43cea2 60%, #185a9d 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 12px 36px;
            border-radius: 30px;
            margin-top: 24px;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(67,206,162,0.15);
        }
        .btn-main:hover {
            background: linear-gradient(90deg, #185a9d 60%, #43cea2 100%);
            transform: scale(1.05);
        }
        .kost-card {
            background: rgba(255,255,255,0.95);
            color: #185a9d;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(67,206,162,0.10);
            padding: 24px 18px;
            margin-bottom: 24px;
            border: 1.5px solid #e0eafc;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            z-index: 1;
        }
        .kost-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(67,206,162,0.18);
        }
        .kost-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #185a9d;
        }
        .kost-detail {
            font-size: 1rem;
            margin-bottom: 6px;
            color: #444;
        }
        .kost-btn {
            background: linear-gradient(90deg, #43cea2 60%, #185a9d 100%);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 6px 20px;
            font-size: 0.95em;
            transition: background 0.2s;
            font-weight: 500;
        }
        .kost-btn:hover {
            background: linear-gradient(90deg, #185a9d 60%, #43cea2 100%);
        }
        @media (max-width: 767px) {
            .landing-content {
                padding: 24px 8px 24px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="landing-content shadow-lg">
            <div class="text-center mb-4">
                <img src="https://img.icons8.com/ios-filled/100/6a11cb/lock-2.png" alt="SIKO Logo" style="width:60px;height:60px;border-radius:50%;box-shadow:0 2px 8px #43cea233;">
                <div class="main-title mt-2">Selamat Datang di SIKO</div>
                <div class="subtitle mb-2">Sistem Informasi Kos Modern</div>
            </div>
            <p class="mb-4 text-center" style="color:#444;">
                SIKO hadir untuk memudahkan pengelolaan dan pencarian kos secara online dengan tampilan yang nyaman dan fitur lengkap.
            </p>
            <h4 class="fw-semibold mt-4 mb-2" style="color:#185a9d;">Sejarah Kos</h4>
            <p style="text-align:justify; color:#444;">
                Kos-kosan ini berdiri sejak tahun 2010 dan telah menjadi pilihan utama mahasiswa dan pekerja di sekitar area kampus. Dengan fasilitas lengkap, lingkungan nyaman, dan pengelolaan profesional, SIKO hadir untuk memudahkan proses pencarian dan pengelolaan kos secara digital.
            </p>
            <h4 class="fw-semibold mt-4 mb-3" style="color:#185a9d;">Daftar Kos Tersedia</h4>
            <div class="row">
                <!-- Kos 1 -->
                <div class="col-md-4">
                    <div class="kost-card">
                        <div class="kost-title">Kos Mawar Indah</div>
                        <div class="kost-detail">Jl. Melati No. 10, Dekat Kampus A</div>
                        <div class="kost-detail">Fasilitas: WiFi, AC, Kamar Mandi Dalam, Parkir</div>
                        <div class="kost-detail">Harga: <b>Rp 800.000/bulan</b></div>
                        <a href="#" class="kost-btn mt-2">Lihat Detail</a>
                    </div>
                </div>
                <!-- Kos 2 -->
                <div class="col-md-4">
                    <div class="kost-card">
                        <div class="kost-title">Kos Anggrek Asri</div>
                        <div class="kost-detail">Jl. Kenanga No. 5, Dekat Kampus B</div>
                        <div class="kost-detail">Fasilitas: WiFi, Kipas Angin, Dapur Bersama</div>
                        <div class="kost-detail">Harga: <b>Rp 650.000/bulan</b></div>
                        <a href="#" class="kost-btn mt-2">Lihat Detail</a>
                    </div>
                </div>
                <!-- Kos 3 -->
                <div class="col-md-4">
                    <div class="kost-card">
                        <div class="kost-title">Kos Melati Putih</div>
                        <div class="kost-detail">Jl. Dahlia No. 12, Dekat Pusat Kota</div>
                        <div class="kost-detail">Fasilitas: WiFi, AC, Laundry, Keamanan 24 Jam</div>
                        <div class="kost-detail">Harga: <b>Rp 1.000.000/bulan</b></div>
                        <a href="#" class="kost-btn mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('loginform') }}" class="btn btn-main">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
