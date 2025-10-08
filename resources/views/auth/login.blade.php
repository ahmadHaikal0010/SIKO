<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login • SIKO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle at 20% 20%, #7fd1e8 0%, #3a7bd5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: #eaf6fa;
            border-radius: 18px;
            box-shadow: 0 12px 40px 0 rgba(31,38,135,0.18);
            padding: 40px 32px 32px 32px;
            width: 420px;
            max-width: 95vw;
        }
        .login-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #3686d6;
            text-align: center;
            margin-bottom: 32px;
            letter-spacing: 1px;
            background: #bfe2f7;
            border-radius: 12px;
            box-shadow: 0 6px 16px #bfe2f7;
            padding: 14px 0 10px 0;
            text-shadow: 1px 2px 6px #bfe2f7;
        }
        .form-label {
            font-weight: 500;
            color: #3686d6;
            margin-bottom: 6px;
            font-size: 1.08em;
            display: block;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #bfe2f7;
            font-size: 1.1em;
            padding: 14px 12px;
            background: #eaf6fa;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #3686d6;
            box-shadow: 0 0 8px #7fd1e8;
            background: #eaf6fa;
        }
        .input-group-text {
            background: #eaf6fa;
            border: none;
        }
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0px;
            margin-bottom: 18px;
        }
        .btn-login {
            background: #2ca6c4;
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 14px 0;
            font-size: 1.15em;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            transition: background 0.2s;
            box-shadow: 0 4px 16px #bfe2f7;
        }
        .btn-login:hover {
            background: #3686d6;
        }
        .or-divider {
            text-align: center;
            color: #888;
            margin: 18px 0 10px 0;
            font-weight: 500;
        }
        .google-btn {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px #bfe2f7;
            border: none;
            width: 100%;
            padding: 14px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.08em;
            font-weight: 500;
            color: #444;
            margin-bottom: 8px;
            gap: 10px;
        }
        .google-btn img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .forgot-link {
            color: #3686d6;
            text-decoration: none;
            font-size: 0.98em;
            font-weight: 500;
        }
        .forgot-link:hover {
            text-decoration: underline;
            color: #2ca6c4;
        }
        .error-message {
            color: #d9534f;
            font-size: 0.98em;
            margin-bottom: 8px;
            text-align: center;
        }
        .form-check-input {
            accent-color: #3686d6;
        }
        @media (max-width: 500px) {
            .login-card { padding: 18px 4vw 18px 4vw; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-title">LOGIN</div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success mb-3">{{ session('status') }}</div>
        @endif

        <!-- Error Message -->
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    <span class="input-group-text">
                        <i class="bi bi-eye" style="cursor:pointer;" onclick="togglePassword()"></i>
                    </span>
                </div>
            </div>

            <div class="remember-row">
                <div>
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" style="font-size:0.98em; color:#444;">Remember</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-login">CONTINUE</button>
        </form>

        <div class="or-divider">Or</div>
        <button class="google-btn" type="button">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
            Log In with Google
        </button>
    </div>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script>
        function togglePassword() {
            var input = document.getElementById('password');
            var icon = event.target;
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
