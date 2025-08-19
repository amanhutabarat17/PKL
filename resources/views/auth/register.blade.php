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
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-blue-50 p-4">

    <!-- Kontainer utama form pendaftaran -->
    <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
            <p class="text-gray-500">Silakan isi formulir di bawah ini.</p>
        </div>
        
        <!-- Formulir Pendaftaran -->
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Bidang Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" id="name" name="name" required autofocus autocomplete="name"
                        class="mt-1 block w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-colors">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bidang Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" required autocomplete="username"
                        class="mt-1 block w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-colors">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bidang Kata Sandi -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                <input type="password" id="password" name="password" required autocomplete="new-password"
                        class="mt-1 block w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-colors">
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bidang Konfirmasi Kata Sandi -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>

            <!-- Bagian Tombol dan Tautan -->
            <div class="flex items-center justify-between mt-6">
                <!-- Tautan Sudah Terdaftar -->
                <a href="/login" class="underline text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Sudah terdaftar?
                </a>
                
                <!-- Tombol Daftar -->
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl shadow-md hover:bg-blue-700 transition-all duration-300">
                    Daftar
                </button>
            </div>
            
        </form>
    </div>

</body>
</html>
