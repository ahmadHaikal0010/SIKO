<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login • SIKO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(160deg, #e0e5e5 0%, #a9b8bc 40%, #758c92 100%);
      font-family: 'Poppins', sans-serif;
      animation: fadeIn 1.2s ease forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-wrapper {
      position: relative;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(14px);
      border-radius: 14px;
      box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
      padding: 70px 40px 45px;
      width: 380px;
      max-width: 90vw;
      text-align: center;
      animation: slideUp 1.4s ease forwards;
    }

    @keyframes slideUp {
      from { transform: translateY(30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .profile-icon {
      position: absolute;
      top: -50px;
      left: 50%;
      transform: translateX(-50%);
      background: #2f4f4f;
      color: #fff;
      width: 90px;
      height: 90px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      animation: fadeDown 1s ease;
    }

    @keyframes fadeDown {
      from { opacity: 0; transform: translate(-50%, -20px); }
      to { opacity: 1; transform: translate(-50%, 0); }
    }

    .input-group {
      background: rgba(255, 255, 255, 0.4);
      border-radius: 6px;
      margin-bottom: 18px;
      transition: box-shadow 0.3s ease;
    }

    .input-group:hover {
      box-shadow: 0 0 8px rgba(47, 79, 79, 0.25);
    }

    .input-group-text {
      background: transparent;
      border: none;
      color: #2b3a3a;
      padding-left: 14px;
      font-size: 1.2rem;
    }

    .form-control {
      background: transparent;
      border: none;
      padding: 12px 14px;
      color: #2b3a3a;
      font-size: 1rem;
    }

    .form-control:focus {
      box-shadow: none;
      background: rgba(255, 255, 255, 0.6);
    }

    .btn-login {
      width: 100%;
      background-color: #2f4f4f;
      color: #fff;
      border: none;
      border-radius: 25px;
      padding: 12px;
      font-size: 1.05rem;
      font-weight: 500;
      transition: all 0.3s ease;
      margin-top: 5px;
      margin-bottom: 20px;
      box-shadow: 0 6px 18px rgba(47, 79, 79, 0.25);
    }

    .btn-login:hover {
      background-color: #263f3f;
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(47, 79, 79, 0.3);
    }

    .remember-me {
      text-align: left;
      margin-bottom: 12px;
      font-size: 0.95rem;
      color: #2b3a3a;
    }

    .error-message {
      color: #d9534f;
      font-size: 0.9rem;
      margin-bottom: 10px;
    }

    /* Link registrasi yang elegan */
    .register-link {
      display: inline-block;
      color: #2f4f4f;
      font-size: 0.98rem;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .register-link:hover {
      color: #1f3838;
      transform: scale(1.05);
      text-decoration: underline;
    }

    @media (max-width: 500px) {
      .login-wrapper {
        padding: 60px 25px 35px;
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="profile-icon">
      <i class="bi bi-person"></i>
    </div>

    <!-- Error Message -->
    @if ($errors->any())
      <div class="error-message">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="input-group mt-3">
        <span class="input-group-text"><i class="bi bi-person"></i></span>
        <input type="text" class="form-control" name="email" placeholder="Username" required autofocus>
      </div>

      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>

      <div class="form-check remember-me">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label for="remember" class="form-check-label">Remember me</label>
      </div>

      <button type="submit" class="btn btn-login">Login</button>
    </form>

    <!-- Link ke halaman registrasi -->
    <div>
      <span style="color:#555;">Belum punya akun?</span>
      <a href="{{ route('register') }}" class="register-link ms-1">Buat akun sekarang</a>
    </div>
  </div>
</body>
</html>
