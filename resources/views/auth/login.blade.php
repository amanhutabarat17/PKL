<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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

        .login-container {
            max-width: 450px;
            width: 100%;
            background: linear-gradient(to bottom, #ffffff, var(--bpjs-bg-light-1));
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .header-login {
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

        .alert-status {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: left;
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-error {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: left;
            background-color: #fee2e2;
            color: #991b1b;
        }

        .forgot-password-link {
            text-decoration: underline;
            color: #4a5568;
            font-size: 0.875rem;
            display: block;
            text-align: right;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1 class="header-login">Masuk ke Akun Anda</h1>

    @if(session('status'))
    <div class="alert-status">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <p class="alert-error mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Kata Sandi</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <p class="alert-error mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mt-4">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
        </div>

        @if (Route::has('password.request'))
            <a class="forgot-password-link" href="{{ route('password.request') }}">
                Lupa kata sandi Anda?
            </a>
        @endif

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn-bpjs-green px-6 py-2">
                Masuk
            </button>
        </div>
    </form>
    
    <!-- Tombol Kembali -->
    <a href="{{ route('welcome') }}" class="btn-secondary">
        Kembali
    </a>
</div>

</body>
</html>
