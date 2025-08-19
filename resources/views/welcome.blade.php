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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-blue-500 min-h-screen flex flex-col items-center justify-center p-6 lg:p-8">

    <!-- Kontainer utama untuk navbar -->
    <div class="w-full max-w-4xl p-6">
        <!-- Kotak navbar yang berwarna biru muda dengan border putih dan sudut membulat -->
        <nav class="bg-blue-300 border-4 border-white rounded-2xl shadow-xl p-4 lg:p-6 flex justify-between items-center">
            
            <!-- Bagian kiri navbar dengan logo -->
            <div class="flex items-center space-x-4">
                <a href="#">
                    <!-- Gambar placeholder untuk logo BPJS Ketenagakerjaan -->
                    <img id="Gambar/BPJS" src="https://placehold.co/150x48/60a5fa/ffffff?text=BPJS+Ketenagakerjaan" alt="Logo BPJS Ketenagakerjaan" class="h-12 w-auto rounded-lg object-cover transition-all duration-300">
                </a>
            </div>
            
            <!-- Bagian kanan navbar dengan tombol Login/Register -->
            <div class="flex items-center space-x-4 text-base font-medium">
                <!-- Tautan Login -->
                <a href="/login" class="inline-block px-5 py-2 font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md hover:shadow-xl transition-all duration-300">
                    Login
                </a>
                
                <!-- Tautan Register -->
                <a href="/register" class="inline-block px-5 py-2 font-medium text-blue-800 bg-white hover:bg-gray-100 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    Register
                </a>
            </div>
        </nav>

        <!-- Teks besar di bawah navbar -->
        <div class="mt-12 text-center">
            <h1 class="text-4xl lg:text-6xl font-extrabold text-white leading-tight">
                Sistem Penjadwalan Kunjungan JKM<br>BPJS Ketenagakerjaan
            </h1>
        </div>

    </div>

</body>
</html>