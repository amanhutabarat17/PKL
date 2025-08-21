<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pendaftaran</title>
    
    <!-- Memuat font Inter dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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

        .register-container {
            max-width: 450px;
            width: 100%;
            background: linear-gradient(to bottom, #ffffff, var(--bpjs-bg-light-1));
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .header-register {
            color: var(--bpjs-text-color);
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 2.25rem; /* text-4xl */
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.25rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--bpjs-border-color);
            border-radius: 0.5rem;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus {
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

        .btn-secondary {
            width: 100%;
            border: 2px solid var(--bpjs-light-green);
            color: var(--bpjs-light-green);
            background-color: transparent;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            margin-top: 1rem;
        }

        .btn-secondary:hover {
            background-color: rgba(0, 153, 68, 0.1);
        }

        .alert-error {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-top: 0.5rem;
            font-weight: 600;
            text-align: left;
            background-color: #fee2e2;
            color: #991b1b;
        }

        .login-link {
            text-decoration: underline;
            color: #4a5568;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h1 class="header-register">Buat Akun Baru</h1>
    
    <!-- Formulir Pendaftaran -->
    <form action="{{ route('register') }}" method="POST">
        @csrf
        
        <!-- Bidang Nama -->
        <div class="form-group">
            <label for="name" class="form-label">Nama</label>
            <input type="text" id="name" name="name" required autofocus autocomplete="name"
                    class="form-input" value="{{ old('name') }}">
            @error('name')
                <p class="alert-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bidang Email -->
        <div class="form-group">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" id="email" name="email" required autocomplete="username"
                    class="form-input" value="{{ old('email') }}">
            @error('email')
                <p class="alert-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bidang Kata Sandi -->
        <div class="form-group">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" id="password" name="password" required autocomplete="new-password"
                    class="form-input">
            @error('password')
                <p class="alert-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bidang Konfirmasi Kata Sandi -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                    class="form-input">
        </div>

        <!-- Tombol Daftar -->
        <button type="submit" class="btn-bpjs-green mt-6">
            Daftar
        </button>
        
    </form>
    
    <!-- Tombol Kembali dan Tautan Sudah Terdaftar -->
    <div class="flex items-center justify-between mt-4">
        <a href="{{ route('welcome') }}" class="btn-secondary w-1/2 mr-2">
            Kembali
        </a>
        <a href="{{ route('login') }}" class="underline text-sm text-gray-500 hover:text-gray-700 font-medium ml-2">
            Sudah terdaftar?
        </a>
    </div>
</div>

</body>
</html>
