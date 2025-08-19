<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjadwalan JKM BPJS Ketenagakerjaan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Gradasi latar belakang hijau-putih yang bersih */
            background: linear-gradient(135deg, #d1fae5 0%, #ffffff 100%);
            color: #1f2937; /* Warna teks yang lebih gelap untuk kontras */
        }
        /* Mengubah warna teks highlight menjadi hijau yang serasi */
        .text-blue-600 {
            color: #10b981; /* Hijau emerald */
        }
        /* Animasi ikon berputar dan bersinar dengan warna hijau */
        .icon-bounce {
            animation: bounce-glow-green 2s ease-in-out infinite;
        }
        @keyframes bounce-glow-green {
            0%, 100% {
                transform: translateY(-5%);
                filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.5));
            }
            50% {
                transform: translateY(5%);
                filter: drop-shadow(0 0 20px rgba(16, 185, 129, 0.8));
            }
        }
        /* Efek hover untuk kartu */
        .card-shadow:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1), 0 0 60px rgba(16, 185, 129, 0.2);
            transform: translateY(-5px);
        }
        /* Mengubah warna tautan dan tombol */
        .text-blue-300 {
            color: #059669; /* Hijau gelap */
        }
        .bg-gray-700 {
            background-color: #f3f4f6; /* Abu-abu sangat muda */
        }
        .hover\:bg-gray-600:hover {
            background-color: #e5e7eb;
        }
        .bg-gradient-to-r {
            background: linear-gradient(to right, #10b981, #059669); /* Gradasi hijau */
        }
        .hover\:from-blue-600:hover {
            --tw-gradient-from: #059669;
            --tw-gradient-to: #047857;
        }
        .border-gray-700 {
            border-color: #d1d5db; /* Border abu-abu muda */
        }
        .bg-gray-800 {
            background-color: #ffffff; /* Latar belakang navbar putih */
        }
        .text-white {
            color: #ffffff;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4 sm:p-6">

    <div class="w-full max-w-7xl mx-auto flex flex-col items-center">

        <nav class="w-full bg-white bg-opacity-70 backdrop-filter backdrop-blur-lg border border-gray-200 rounded-2xl shadow-lg p-4 lg:p-6 flex justify-between items-center transition-all duration-500 transform hover:scale-[1.01]">
            
            <div class="flex items-center space-x-4">
                <a href="#" class="flex items-center space-x-2">
            <img src="{{ asset('Gambar/logo.png') }}" class="h-12 w-auto">
                </a>
            </div>
            
            <div class="flex items-center space-x-4 font-semibold">
                <a href="/login" class="inline-block px-5 py-2 text-green-700 bg-gray-100 hover:bg-gray-200 rounded-xl shadow-md transition-all duration-300">
                    Login
                </a>
                
                <a href="/register" class="inline-block px-5 py-2 text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 rounded-xl shadow-lg transition-all duration-300">
                    Register
                </a>
            </div>
        </nav>

        <div class="mt-20 sm:mt-28 text-center px-4">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-800 leading-tight tracking-tight drop-shadow-lg">
                Sistem Penjadwalan Kunjungan JKM<br><span class="text-green-600">BPJS Ketenagakerjaan</span>
            </h1>
            <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                Kelola jadwal kunjungan Jaminan Kematian dengan mudah, efisien, dan transparan.
            </p>
        </div>

        <div class="mt-16 w-full max-w-4xl p-8 sm:p-12 bg-white rounded-3xl shadow-xl transition-all duration-500 card-shadow">
            <div class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mb-6 text-green-500 icon-bounce" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 12c2.21 0 4 -1.127 4 -2.5s-1.79 -2.5 -4 -2.5c-2.21 0 -4 1.127 -4 2.5s1.79 2.5 4 2.5z"></path>
                    <path d="M12 12v6c0 1.657 2.686 3 6 3c3.314 0 6 -1.343 6 -3v-6"></path>
                    <path d="M12 12v6c0 1.657 -2.686 3 -6 3c-3.314 0 -6 -1.343 -6 -3v-6"></path>
                    <path d="M12 12v6c0 1.657 2.686 3 6 3c3.314 0 6 -1.343 6 -3v-6"></path>
                </svg>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Ayo Login</h2>
                <p class="text-base text-gray-500 max-w-xl text-center">
                    "Sistem ini berfungsi sebagai platform terpadu untuk penyediaan dan pemantauan
                     jadwal kunjungan Jaminan Kematian (JKM). Dengan fitur pembaruan status real-time,
                    Anda dapat melacak setiap kunjungan, mengelola penugasan,
                    dan memastikan seluruh proses berjalan lancar, efisien, dan tanpa hambatan."
                </p>
            </div>
        </div>
    </div>
</body>
</html>