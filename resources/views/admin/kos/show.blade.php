<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kos • SIKO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f9fc;
            font-family: 'Poppins', sans-serif;
        }
        .kost-card {
            background: rgba(255,255,255,0.95);
            color: #185a9d;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(67,206,162,0.10);
            padding: 24px 18px;
            margin: 48px auto;
            border: 1.5px solid #e0eafc;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            z-index: 1;
            max-width: 400px;
        }
        .kost-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #185a9d;
        }
        .kost-detail {
            font-size: 1rem;
            margin-bottom: 8px;
            color: #444;
        }
        .btn-back {
            background: linear-gradient(90deg, #43cea2 60%, #185a9d 100%);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 24px;
            font-weight: 500;
            margin-top: 18px;
            transition: background 0.2s;
        }
        .btn-back:hover {
            background: linear-gradient(90deg, #185a9d 60%, #43cea2 100%);
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height:100vh;">
        <div class="kost-card">
            <div class="kost-title">{{ $kos['nama'] }}</div>
            <div class="kost-detail"><b>Alamat:</b> {{ $kos['alamat'] }}</div>
            <div class="kost-detail"><b>Fasilitas:</b> {{ $kos['fasilitas'] }}</div>
            <div class="kost-detail"><b>Harga:</b> {{ $kos['harga'] }}</div>
            <!-- Tambahkan tombol aksi lain di sini jika perlu -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-back w-100 mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
