<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pembelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: white;
        }
        .welcome-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 60px 40px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .welcome-container h1 {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .welcome-container p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .btn-login {
            padding: 12px 40px;
            font-size: 1.1em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>📚 Selamat Datang</h1>
        <p>Sistem Pembelajaran Interaktif</p>
        <p style="font-size: 0.95em; opacity: 0.9;">Silakan login dengan akun Anda untuk melanjutkan</p>
        <a href="{{ route('login.form') }}" class="btn btn-light btn-lg btn-login">Masuk</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
