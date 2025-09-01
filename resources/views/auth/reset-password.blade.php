<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan meta tag untuk token CSRF agar token bisa diperbarui -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #f0fdf4, #d1fae5);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .form-container {
            max-width: 450px;
            width: 100%;
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-input:focus {
            border-color: #009944;
            box-shadow: 0 0 0 4px rgba(0, 153, 68, 0.2);
        }
        .btn-bpjs-green {
            width: 100%;
            background: linear-gradient(to right, #009944, #00643B);
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
            background: linear-gradient(to right, #00643B, #009944);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 153, 68, 0.5);
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Atur Ulang Kata Sandi</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <!-- Input tersembunyi untuk email dan token -->
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Kata Sandi Baru</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="form-input">
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Kata Sandi</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="form-input">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="btn-bpjs-green">
                    Atur Ulang Kata Sandi
                </button>
            </div>
        </form>
    </div>
</body>
</html>
