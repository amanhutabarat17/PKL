<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #0056b3;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }
        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verifikasi Akun Anda</h1>
        <p>Halo,</p>
        <p>Terima kasih telah mendaftar. Gunakan kode verifikasi berikut untuk melanjutkan:</p>
        <h2 class="otp-code">{{ $otp }}</h2>
        <p>Kode ini hanya berlaku untuk waktu yang terbatas.</p>
        <p>Hormat kami,<br>Tim {{ config('app.name') }}</p>
    </div>
</body>
</html>