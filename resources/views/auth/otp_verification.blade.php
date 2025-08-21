<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bpjs-dark-green: #00643B;
            --bpjs-light-green: #009944;
            --bpjs-text-color: #1a202c;
            --bpjs-border-color: #e2e8f0;
            --bpjs-bg-light-1: #f0fdf4;
            --bpjs-bg-light-2: #d1fae5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, var(--bpjs-bg-light-1), var(--bpjs-bg-light-2));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* Perubahan utama: Menambahkan gradien latar belakang ke kontainer OTP */
        .otp-container {
            max-width: 450px;
            width: 100%;
            background: linear-gradient(to bottom, #ffffff, var(--bpjs-bg-light-1));
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .header-otp {
            color: var(--bpjs-text-color);
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 2.25rem; /* text-4xl */
        }

        .info-text {
            color: #6b7280;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control-otp {
            width: 100%;
            padding: 0.75rem 1.25rem;
            font-size: 1.25rem;
            text-align: center;
            border: 2px solid var(--bpjs-border-color);
            border-radius: 0.5rem;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control-otp:focus {
            border-color: var(--bpjs-light-green);
            box-shadow: 0 0 0 4px rgba(0, 153, 68, 0.2);
        }

        .btn-bpjs-green {
            width: 100%;
            background: linear-gradient(to right, var(--bpjs-light-green), var(--bpjs-dark-green));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-transform: uppercase;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 153, 68, 0.3);
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            cursor: pointer;
        }

        .btn-bpjs-green:hover {
            background: linear-gradient(to right, var(--bpjs-dark-green), var(--bpjs-light-green));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 153, 68, 0.5);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: left;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-color: #fca5a5;
        }
    </style>
</head>
<body>

<div class="otp-container">
    <h1 class="header-otp">Verifikasi Kode OTP</h1>

    <p class="info-text">
        Kode verifikasi telah dikirim ke email <strong>{{ $email }}</strong>. Silakan masukkan kode di bawah ini.
    </p>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('verification.otp.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        
        <div class="form-group">
            <label for="otp_code" class="sr-only">Kode OTP</label>
            <input id="otp_code" type="text" name="otp_code" class="form-control-otp" required autofocus placeholder="Masukkan Kode OTP">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-bpjs-green">
                Verifikasi
            </button>
        </div>
    </form>
</div>

</body>
</html>
