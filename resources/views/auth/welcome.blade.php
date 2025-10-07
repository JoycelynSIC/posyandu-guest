<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Posyandu Guest</title>

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

        .welcome-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 50px 40px;
            text-align: center;
            max-width: 480px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-card h1 {
            font-weight: 600;
            color: #007b83;
            margin-bottom: 15px;
        }

        .welcome-card p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .footer-text {
            margin-top: 25px;
            color: #888;
            font-size: 0.85rem;
        }

        .welcome-img {
            width: 180px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966330.png" alt="Logo Posyandu Anak" class="welcome-img">


        <h1>Selamat Datang, {{ $username }}!</h1>
        <p>Senang melihatmu kembali di website <strong>Posyandu Bina Muda!</strong></p>

        <p class="footer-text">© {{ date('Y') }} Posyandu Guest</p>
    </div>
</body>
</html>