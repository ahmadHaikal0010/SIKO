<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register • SIKO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #dfe7e7 0%, #b2c5c9 40%, #7a8f94 100%);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Fade-in animation */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .register-wrapper {
            position: relative;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(14px);
            border-radius: 14px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
            padding: 70px 40px 45px;
            width: 400px;
            max-width: 90vw;
            text-align: center;
            transform: translateY(-20px);
            animation: slideFade 0.8s forwards;
        }

        @keyframes slideFade {
            to {
                transform: translateY(0);
                opacity: 1;
            }
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-icon:hover {
            transform: translateX(-50%) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .input-group {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 6px;
            margin-bottom: 18px;
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

        .btn-register {
            width: 100%;
            background-color: #2f4f4f;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-size: 1.05rem;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s ease;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .btn-register:hover {
            background-color: #263f3f;
            color: #fff;
            transform: scale(1.03);
        }

        /* Tombol login dengan efek garis animasi */
        .btn-login {
            position: relative;
            display: inline-block;
            padding: 10px 0;
            width: 100%;
            color: #2f4f4f;
            text-decoration: none;
            font-weight: 500;
            overflow: hidden;
            border-radius: 25px;
            transition: color 0.3s ease, transform 0.3s ease;
            margin-top: 10px;
        }

        /* .btn-login::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 0;
            height: 100%;
            background-color: #2f4f4f;
            z-index: -1;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease;
            border-radius: 25px;
        } */

        .btn-login:hover {
            color: #1f3838;
            transform: scale(1.05);
            text-decoration: underline;
        }

        /* .btn-login:hover::before {
            width: 100%;
        } */

        .error-message {
            color: #d9534f;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        @media (max-width: 500px) {
            .register-wrapper {
                padding: 60px 25px 35px;
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="register-wrapper fade-in">
        <div class="profile-icon">
            <i class="bi bi-person-plus"></i>
        </div>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mt-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                    placeholder="Name" required autofocus>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                    placeholder="Email" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                    required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                    placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-register">Register</button>

            <a href="{{ route('login') }}" class="btn-login">Back to Login</a>
        </form>
    </div>
</body>

</html>
