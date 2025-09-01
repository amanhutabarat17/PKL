<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
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

        .container {
            max-width: 450px;
            width: 100%;
            background: linear-gradient(to bottom, #ffffff, var(--bpjs-bg-light-1));
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .header {
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

<div class="container">
    <h1 class="header">Lupa Kata Sandi</h1>
    <p class="mb-4 text-gray-600">
        Masukkan alamat email Anda yang terdaftar, dan kami akan mengirimkan Anda kode OTP.
    </p>

    @if (session('status'))
        <div class="alert-status">
            {{ session('status') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input" type="email" name="email" required autofocus />
        </div>
        <button type="submit" class="btn-bpjs-green">
            Kirim OTP
        </button>
    </form>
</div>

</body>
</html>
