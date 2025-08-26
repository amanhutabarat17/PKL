<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPJS Ketenagakerjaan</title>
    <!-- Tailwind CSS CDN untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk fungsionalitas menu dropdown dan toggle -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Perubahan utama: Gunakan gradasi warna yang cerah dan sesuai brand */
            background-color: #f3f4f6;
        }

        /* Kelas kustom untuk bayangan yang lebih kuat dan berkelas */
        .shadow-custom {
            /* Perubahan: Gunakan bayangan dengan warna yang lebih sesuai (hijau/emerald) */
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.1), 0 10px 10px -5px rgba(16, 185, 129, 0.04);
        }
    </style>
</head>

<!-- Perubahan utama: Ganti warna latar belakang body dengan gradasi warna yang lebih cerah dan sesuai brand -->
<body class="bg-gradient-to-br from-green-50 to-teal-50 min-h-screen antialiased">
    
     @include('layouts.navigation')

    <!-- Padding atas untuk mengimbangi fixed navbar -->
    <div class="pt-24"></div>

    <div class="container mx-auto p-4 sm:p-8">
        <!-- Message Box -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4 shadow-md" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4 shadow-md" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content Section: Desain lebih modern dengan bayangan custom -->
        <div class="bg-white rounded-3xl shadow-custom p-6 sm:p-10 my-8 border border-gray-200">
            <div class="flex flex-col items-center justify-center mb-6">
                <!-- Logo di konten utama - diperbesar dari w-64 sm:w-80 menjadi w-80 sm:w-96 -->
                <img src="{{ asset('gambar/BPJS.png') }}" alt="Logo BPJS Ketenagakerjaan" class="w-80 sm:w-96 h-auto mb-4 drop-shadow-lg">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-center text-emerald-700 drop-shadow-md">
                    BPJS Ketenagakerjaan
                </h1>
            </div>
            <p class="text-lg sm:text-xl text-gray-700 text-center leading-relaxed">
                BPJS Ketenagakerjaan (Badan Penyelenggara Jaminan Sosial Ketenagakerjaan)
                adalah lembaga publik yang bertugas menyelenggarakan jaminan sosial
                bagi seluruh pekerja di Indonesia. Tujuannya adalah untuk
                melindungi dan menyejahterakan pekerja serta keluarganya.
            </p>
        </div>

        <!-- Photo Upload Section: Desain lebih interaktif -->
        <div class="bg-white rounded-3xl shadow-custom p-6 sm:p-8 my-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                Unggah Foto
            </h2>
            <form action="{{ route('bpjs.ketenagakerjaan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Tombol Unggah File yang lebih stylish -->
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-green-300 border-dashed rounded-xl cursor-pointer bg-green-50 hover:bg-green-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v8"></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span> atau seret dan lepas</p>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="photo" class="hidden" required />
                    </label>
                </div>
                
                <!-- TextArea dengan efek fokus yang lebih menawan -->
                <textarea name="description" rows="3" placeholder="Tambahkan deskripsi foto di sini..." class="p-4 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-400 focus:ring-opacity-50 transition-shadow duration-200"></textarea>

                <div class="text-center">
                    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-emerald-600 text-white font-bold rounded-full transition-all duration-300 transform hover:scale-105 hover:bg-emerald-700 shadow-xl shadow-green-600/50">
                        Unggah Foto
                    </button>
                </div>
            </form>
        </div>

        <!-- Gallery Section: Kartu galeri yang lebih elegan dan interaktif -->
        <div class="bg-white rounded-3xl shadow-custom p-6 sm:p-8 my-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                Galeri Foto
            </h2>
            @if(count($photos) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($photos as $photo)
                        <div class="relative w-full overflow-hidden rounded-2xl shadow-xl transform transition-all duration-500 hover:scale-105 group border border-gray-200">
                            <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->description }}" class="w-full h-56 object-cover rounded-t-2xl">
                            
                            <!-- Area deskripsi foto dengan latar belakang transparan saat hover -->
                            <div class="p-4 bg-white bg-opacity-95 rounded-b-2xl transition-all duration-500 group-hover:bg-white group-hover:bg-opacity-100">
                                <p class="font-semibold text-gray-800">{{ $photo->description ?? 'Tidak ada deskripsi' }}</p>
                                <p class="text-sm text-gray-500 mt-1">Diunggah: {{ $photo->created_at->format('d M Y') }}</p>
                            </div>
                            
                            <!-- Tombol hapus yang muncul saat hover -->
                            <form action="{{ route('bpjs.ketenagakerjaan.destroy', $photo->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" 
                                    class="absolute top-4 right-4 text-white bg-red-600 rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-0 group-hover:scale-100 origin-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1H9a1 1 0 00-1 1v3m.867 12.142A2 2 0 015 19.142M16 12v6m-4-6v6m4-6h.01"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 italic p-8">Belum ada foto yang diunggah.</p>
            @endif
        </div>
    </div>
</body>
</html>
