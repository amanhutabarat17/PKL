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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        /* Gaya Dasar & Palet Warna */
        :root {
            --primary-green: #009944; /* Hijau kuat dari BPJS */
            --secondary-green: #008080; /* Teal dari BPJS */
            --light-green: #e6ffee; /* Latar belakang hijau sangat muda */
            --dark-gray: #374151;
            --medium-gray: #6b7280;
            --border-light: #e5e7eb;
            --success-text: #065f46;
            --error-red: #b91c1c;
            --light-red: #fee2e2;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            padding: 2rem 0;
            color: var(--dark-gray);
        }

        /* Kelas kustom untuk bayangan yang lebih kuat dan berkelas */
        .shadow-custom {
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.1), 0 10px 10px -5px rgba(16, 185, 129, 0.04);
        }

        /* Gaya Alert di Tengah Layar */
        .centered-alert-container {
            position: fixed;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: fit-content;
            max-width: 90%;
            pointer-events: none; /* Agar tidak menghalangi interaksi di bawahnya */
        }

        .alert-base {
            border-radius: 0.75rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: fadeInDownScale 0.6s ease-out forwards;
            opacity: 0;
            transform-origin: top center;
        }
        
        .alert-base .alert-icon {
            font-size: 1.8rem;
        }
        .alert-base .alert-title {
            font-weight: 700;
            font-size: 1.1rem;
        }
        .alert-base .alert-message {
            font-size: 0.95rem;
        }

        /* Gaya Alert Sukses */
        .alert-success {
            background-color: var(--light-green);
            color: var(--success-text);
            border-left: 5px solid var(--primary-green);
        }
        .alert-success .alert-icon {
            color: var(--primary-green);
        }

        /* Gaya Alert Error */
        .alert-error {
            background-color: var(--light-red);
            color: var(--error-red);
            border-left: 5px solid var(--error-red);
        }
        .alert-error .alert-icon {
            color: var(--error-red);
        }

        @keyframes fadeInDownScale {
            0% {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .alert-fade-out {
            animation: fadeOutUp 0.6s ease-in forwards;
        }

        @keyframes fadeOutUp {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 to-teal-50 min-h-screen antialiased">
    
    <!-- Navigation Bar: Desain lebih bold dengan gradasi dan bayangan tebal -->
    <nav x-data="{ menuOpen: false }" class="w-full bg-gradient-to-r from-teal-500 to-emerald-600 shadow-2xl shadow-green-600/50 z-50 fixed top-0">
        <div class="flex justify-between items-center h-20 px-4 md:px-8 lg:px-12">
            <div class="flex items-center gap-10">
                <h1 class="flex items-center">
                    <img src="{{ asset('gambar/BPJS.png') }}" alt="Logo BPJS" class="w-52 h-auto drop-shadow-lg">
                </h1>
                <div class="hidden lg:flex gap-6">
                    <a href="{{ route('bpjs.ketenagakerjaan') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:text-green-600 shadow-xl">
                        BPJS Ketenagakerjaan
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:text-green-600 shadow-xl">
                        Beranda
                    </a>
                    <a href="{{ route('penugasan.index') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:text-green-600 shadow-xl">
                        Penugasan
                    </a>
                </div>
            </div>

            <div x-data="{ open: false }" class="relative flex items-center gap-4">
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="Foto Profil" class="w-14 h-14 rounded-full border-4 border-white shadow-xl">
                <span class="text-white font-medium text-lg hidden md:block">{{ Auth::user()->name }}</span>

                <button @click="open = !open"
                    class="flex items-center gap-2 bg-white text-green-800 text-base font-semibold px-4 py-2 rounded-full shadow-lg shadow-green-500/50 hover:bg-gray-100 transition-all duration-200">
                    <span>Menu</span>
                    <svg class="w-4 h-4 text-green-800 transition-transform duration-200"
                        :class="open ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="absolute right-0 top-16 w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 p-2">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil
                    </a>
                    <a href="{{ route('tentang') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24"></div>

    <div class="container mx-auto p-4 sm:p-8">
        <!-- Placeholder untuk Alert yang akan diinjeksi oleh JavaScript -->
        <div id="alert-placeholder"></div>

        <!-- Main Content Section: Desain lebih modern dengan bayangan custom -->
        <div class="bg-white rounded-3xl shadow-custom p-6 sm:p-10 my-8 border border-gray-200">
            <div class="flex flex-col items-center justify-center mb-6">
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertPlaceholder = document.getElementById('alert-placeholder');
            
            function showAlert(type, title, message) {
                const iconSvg = type === 'success' 
                    ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`
                    : `<svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`;
                
                const alertHtml = `
                    <div class="centered-alert-container">
                        <div class="alert-base alert-${type}" role="alert">
                            <span class="alert-icon">${iconSvg}</span>
                            <div>
                                <p class="alert-title">${title}</p>
                                <p class="alert-message">${message}</p>
                            </div>
                        </div>
                    </div>
                `;
                
                alertPlaceholder.innerHTML = alertHtml;
                const currentAlert = alertPlaceholder.querySelector('.alert-base');

                // Otomatis sembunyikan alert setelah 3 detik
                setTimeout(() => {
                    if (currentAlert) {
                        currentAlert.classList.add('alert-fade-out');
                        currentAlert.addEventListener('animationend', () => {
                            currentAlert.remove();
                        });
                    }
                }, 3000);
            }

            // Cek apakah ada session success dari Laravel
            @if (session('success'))
                showAlert('success', 'Sukses!', '{{ session('success') }}');
            @endif

            // Cek apakah ada error dari Laravel
            @if ($errors->any())
                const errorMessages = `
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                `;
                showAlert('error', 'Gagal!', `<ul class="list-disc list-inside">${errorMessages}</ul>`);
            @endif

            // Fungsi untuk konfirmasi hapus foto
            window.confirmDelete = function() {
                // Di sini Anda bisa menambahkan modal kustom untuk konfirmasi
                // Untuk saat ini, kita menggunakan `confirm` bawaan browser
                return confirm('Apakah Anda yakin ingin menghapus foto ini?');
            }
        });
    </script>
</body>
</html>
