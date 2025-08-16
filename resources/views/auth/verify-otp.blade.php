<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-900">
            Verifikasi Kode OTP
        </h2>
        <p class="mt-2 text-sm text-center text-gray-600">
            Kami telah mengirimkan kode OTP ke email Anda. Silakan masukkan kode tersebut di bawah.
        </p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('verification.verify') }}" method="POST">
            @csrf
            <!-- Anda mungkin perlu mengambil email dari session atau request sebelumnya -->
            <input type="hidden" name="email" value="{{ old('email') ?? session('register_email') }}">
            
            <div>
                <label for="otp" class="sr-only">Kode OTP</label>
                <input id="otp" name="otp" type="text" required class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Kode OTP">
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Verifikasi
                </button>
            </div>
        </form>
    </div>
</body>
</html>
