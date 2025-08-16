<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjadwalan JKM BPJS Ketenagakerjaan</title>
    
    <!-- Memuat font Inter dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8; /* Latar belakang abu-abu muda yang bersih */
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center p-4 sm:p-6 bg-blue-50">

    <!-- Kontainer utama untuk konten -->
    <div class="w-full max-w-7xl mx-auto flex flex-col items-center">

        <!-- Navbar yang elegan dan transparan -->
        <nav class="w-full bg-white bg-opacity-70 backdrop-filter backdrop-blur-lg border-2 border-white rounded-2xl shadow-lg p-4 lg:p-6 flex justify-between items-center transition-all duration-300 transform hover:scale-105">
            
            <!-- Bagian kiri navbar dengan logo SVG -->
            <div class="flex items-center space-x-4">
                <a href="#" class="flex items-center space-x-2">
                    <!-- SVG Logo BPJS Ketenagakerjaan -->
                    <svg class="h-12 w-auto" viewBox="0 0 160 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="160" height="50" rx="8" fill="#1e3a8a"/>
                        <path d="M25 12H32L39 38H32L29 28.5L26 38H19L25 12Z" fill="white"/>
                        <path d="M49 12H56V38H49V12Z" fill="white"/>
                        <path d="M60 12H67V25H77V38H60V12Z" fill="white"/>
                        <path d="M81 12H88V38H81V12Z" fill="white"/>
                        <path d="M92 12H99L106 38H99L96 28.5L93 38H86L92 12Z" fill="white"/>
                        <path d="M116 25C116 18 110 12 103 12C96 12 90 18 90 25C90 32 96 38 103 38C110 38 116 32 116 25ZM109 25C109 21.5 106.3 19 103 19C99.7 19 97 21.5 97 25C97 28.5 99.7 31 103 31C106.3 31 109 28.5 109 25Z" fill="white"/>
                    </svg>
                </a>
            </div>
            
            <!-- Bagian kanan navbar dengan tombol Login/Register -->
            <div class="flex items-center space-x-4 font-semibold">
                <!-- Tautan Login -->
                <a href="/login" class="inline-block px-5 py-2 text-blue-800 bg-white hover:bg-blue-100 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    Login
                </a>
                
                <!-- Tautan Register -->
                <a href="/register" class="inline-block px-5 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md hover:shadow-xl transition-all duration-300">
                    Register
                </a>
            </div>
        </nav>

        <!-- Bagian hero atau judul utama -->
        <div class="mt-16 sm:mt-24 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-blue-900 leading-tight tracking-tight">
                Sistem Penjadwalan Kunjungan JKM<br><span class="text-blue-600">BPJS Ketenagakerjaan</span>
            </h1>
            <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                Kelola jadwal kunjungan Jaminan Kematian dengan mudah, efisien, dan transparan.
            </p>
        </div>

        <!-- Kartu konten utama -->
        <div class="mt-12 w-full max-w-4xl p-8 sm:p-12 bg-white rounded-3xl shadow-2xl transition-all duration-500 transform hover:scale-[1.02]">
            <div class="flex flex-col items-center justify-center">
                <!-- SVG Ikon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mb-6 text-blue-600 animate-bounce" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 12c2.21 0 4 -1.127 4 -2.5s-1.79 -2.5 -4 -2.5c-2.21 0 -4 1.127 -4 2.5s1.79 2.5 4 2.5z"></path>
                    <path d="M12 12v6c0 1.657 2.686 3 6 3c3.314 0 6 -1.343 6 -3v-6"></path>
                    <path d="M12 12v6c0 1.657 -2.686 3 -6 3c-3.314 0 -6 -1.343 -6 -3v-6"></path>
                    <path d="M12 12v6c0 1.657 2.686 3 6 3c3.314 0 6 -1.343 6 -3v-6"></path>
                </svg>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Aplikasi Siap Digunakan</h2>
                <p class="text-base text-gray-500 max-w-xl">
                    Sistem ini dirancang untuk berjalan tanpa error, memberikan Anda fondasi yang kuat untuk mengembangkan aplikasi penjadwalan JKM yang lengkap dan profesional.
                </p>
            </div>
        </div>

    </div>

</body>
</html>
