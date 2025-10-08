
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register • SIKO</title>
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
        .register-card {
            background: #eaf6fa;
            border-radius: 18px;
            box-shadow: 0 12px 40px 0 rgba(31,38,135,0.18);
            padding: 40px 32px 32px 32px;
            width: 420px;
            max-width: 95vw;
        }
        .register-title {
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
        .btn-register {
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
        .btn-register:hover {
            background: #3686d6;
        }
        .login-link {
            color: #3686d6;
            text-decoration: none;
            font-size: 0.98em;
            font-weight: 500;
        }
        .login-link:hover {
            text-decoration: underline;
            color: #2ca6c4;
        }
        .error-message {
            color: #d9534f;
            font-size: 0.98em;
            margin-bottom: 8px;
            text-align: center;
        }
        @media (max-width: 500px) {
            .register-card { padding: 18px 4vw 18px 4vw; }
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-title">REGISTER</div>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                @if ($errors->has('name'))
                    <div class="error-message">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                @if ($errors->has('email'))
                    <div class="error-message">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                @if ($errors->has('password'))
                    <div class="error-message">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                @if ($errors->has('password_confirmation'))
                    <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-register">Register</button>
        </form>

        <div class="text-center mt-3">
            <a class="login-link" href="{{ route('login') }}">
                Already registered?
            </a>
        </div>
    </div>
</body>
</html>
