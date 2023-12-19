<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .welcome-box {
            border-radius: 10px;
            overflow: hidden;
            width: 700px; /* Memperlebar box utama */
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .welcome-box:hover {
            transform: scale(1.02);
        }

        .welcome-header {
            background: linear-gradient(to right, #3498db, #6b5b95);
            color: #fff;
            padding: 30px;
            text-align: center;
        }

        .welcome-content {
            padding: 30px;
            text-align: center;
        }

        .auth-links {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .auth-links a {
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            color: #fff;
        }

        .auth-links .btn-primary {
            background-color: #3498db;
        }

        .auth-links .btn-success {
            background-color: #41b883;
        }

        .kritik-box {
            margin-top: 40px;
        }

        textarea {
            width: calc(100% - 30px);
            padding: 15px;
            margin-top: 20px;
            resize: vertical;
            border-radius: 5px;
        }

        .btn-kirim {
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: linear-gradient(to right, #e74c3c, #c0392b);
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-kirim:hover {
            background: linear-gradient(to right, #c0392b, #e74c3c);
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <div class="welcome-header">
            <h1 class="display-5 font-weight-bold">Selamat Datang di Sistem Informasi Peminjaman Barang</h1>
        </div>
        <div class="welcome-content">
            <p class="lead">Silakan login atau register untuk dapat mengakses fitur-fitur kami.</p>

            <div class="auth-links">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">Register</a>
                @endif
            </div>

            <div class="kritik-box">
                <h3 class="mb-4">Beri Kritik dan Saran</h3>
                <textarea class="form-control" rows="4" placeholder="Tulis kritik dan saran Anda di sini"></textarea>
                <button class="btn-kirim btn btn-danger btn-lg mt-3">Kirim</button>
            </div>
        </div>
    </div>
</body>
</html>
