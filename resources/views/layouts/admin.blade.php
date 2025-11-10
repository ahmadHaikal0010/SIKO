<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard Admin • SIKO')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color:#f5f5f5; font-family:'Inter', sans-serif; }
        .navbar { background-color:#fff; box-shadow:0 3px 10px rgba(0,0,0,0.1); display:flex; justify-content:space-between; align-items:center; }
        .navbar-brand { color:black !important; font-weight:600; letter-spacing:.5px; }
        .logout-btn { background-color:#406f6b; color:#fff; border:none; border-radius:30px; padding:6px 16px; transition:.3s; }
        .logout-btn:hover { background-color:#254846; }
        .landing-btn { background-color:#406f6b; color:white; text-decoration:none; padding:6px 14px; border-radius:30px; font-weight:500; display:flex; align-items:center; transition:.3s; margin-right:15px; }
        .landing-btn i { margin-right:6px; font-size:1.1rem; }
        .landing-btn:hover { background-color:#2f5653; transform:translateY(-1px); }
        .dashboard-card { background:white; border-radius:15px; padding:25px 15px; text-align:center; box-shadow:0 4px 10px rgba(0,0,0,.05); transition:all .3s ease; height:140px; text-decoration:none!important; color:#333; display:block; }
        .dashboard-card:hover { transform:translateY(-5px); box-shadow:0 8px 20px rgba(0,0,0,.1); background-color:#f9fdfd; }
        .dashboard-card i { font-size:2.4rem; color:#315e5b; margin-bottom:10px; transition:.3s; }
        .dashboard-card:hover i { transform:scale(1.15); color:#2a4d4b; }
        .dashboard-card h6 { font-weight:600; font-size:.95rem; margin-top:8px; }
        .alert-custom { background-color:#315e5b; color:#fff; border-radius:8px; padding:12px 15px; font-size:.9rem; box-shadow:0 2px 6px rgba(0,0,0,.1); }
        .fade-in { animation:fadeIn .7s ease-in-out; }
        @keyframes fadeIn { from{opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }
    </style>

    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar px-4">
        <div class="d-flex align-items-center">
            <a href="{{ url('/') }}" class="landing-btn">
                <i class="bi bi-arrow-left-circle"></i> Landing Page
            </a>
            <a class="navbar-brand ms-2" href="{{ route('admin.dashboard') }}">SIKO Admin</a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    {{-- Konten halaman --}}
    <div class="container my-5 fade-in">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
