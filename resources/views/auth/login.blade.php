<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Guest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #00adadff, #7bcaf8ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Poppins", sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px 35px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
            opacity: 0;
            transform: translateY(40px);
            animation: slideUp 0.7s ease-out forwards;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card h3 {
            text-align: center;
            font-weight: 600;
            color: #007b83;
            margin-bottom: 25px;
        }

        .form-control {
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #00adadff;
            box-shadow: 0 0 8px rgba(0,173,173,0.3);
        }

        .btn-login {
            background-color: #007b83;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,123,131,0.2);
        }
        .btn-login:hover {
            background-color: #0097a7;
            transform: scale(1.03);
            box-shadow: 0 6px 14px rgba(0,123,131,0.3);
        }

        .alert {
            font-size: 0.9rem;
            animation: fadeInAlert 0.6s ease-in-out;
        }
        @keyframes fadeInAlert {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .footer-text {
            text-align: center;
            color: #777;
            font-size: 0.85rem;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3>Silakan Login Terlebih Dahulu!</h3>

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Nama Pengguna</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username kamu">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password kamu">
            </div>

            <button type="submit" class="btn btn-login w-100 text-white">Masuk</button>
        </form>

        <p class="footer-text">© {{ date('Y') }} Posyandu Guest</p>
    </div>

</body>
</html>
