<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Navigation Bar</title>
    <!-- Tailwind CSS CDN untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk fungsionalitas menu dropdown -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
{
         --bpjs-bg-light-1: #f0fdf4;
            --bpjs-bg-light-2: #d1fae5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, var(--bpjs-bg-light-1), var(--bpjs-bg-light-2));
        }
    </style>
</head>

<body>
    <!--
    Ini adalah komponen navigasi yang telah ditingkatkan.
    Menggunakan Tailwind CSS untuk styling yang responsif dan modern.
    Menu dropdown akan tersembunyi secara default dan hanya akan muncul saat tombol "Menu" diklik.
    -->
    <nav class="w-full bg-gradient-to-r from-sky-500 via-green-500 to-green-600 shadow-2xl shadow-green-600/50 z-50">
        <div class="flex justify-between items-center h-20 px-8 lg:px-12">
            <!-- Logo dan Tautan Navigasi Utama -->
            <div class="flex items-center gap-10">
                <!-- Placeholder untuk logo -->
                <h1 class="flex items-center">
                    <img src="{{ asset('gambar/logoo.png') }}" alt="Logo BPJS" class="w-40 h-auto drop-shadow-lg">
                </h1>

                <!-- Tautan Beranda, BPJS Ketenagakerjaan dan Penugasan dengan styling baru -->
                <div class="flex gap-4">
                     <!-- Tautan BPJS Ketenagakerjaan -->
                    <a href="{{ route('bpjs.ketenagakerjaan') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 hover:bg-white hover:text-green-600 shadow-xl hover:shadow-green-500/50">
                        BPJS Ketenagakerjaan
                    </a>

                    <!-- Tautan Beranda -->
                    <a href="{{ route('dashboard') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 hover:bg-white hover:text-green-600 shadow-xl hover:shadow-green-500/50">
                        Beranda
                    </a>
                    
                    <!-- Tautan Penugasan -->
                    <a href="{{ route('penugasan.index') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 hover:bg-white hover:text-green-600 shadow-xl hover:shadow-green-500/50">
                        Penugasan
                    </a>
                </div>
            </div>

            <!-- Bagian Profil Pengguna dan Dropdown Menu -->
            <!-- x-data="{ open: false }" memastikan menu tersembunyi di awal -->
            <div x-data="{ open: false }" class="relative flex items-center gap-4">
                <!-- Avatar Pengguna -->
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="Foto Profil" class="w-14 h-14 rounded-full border-4 border-white shadow-xl">
                <span class="text-white font-medium text-lg hidden md:block">{{ Auth::user()->name }}</span>

                <!-- Tombol Menu Dropdown -->
                <!-- @click="open = !open" akan menampilkan/menyembunyikan menu saat diklik -->
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

                <!-- Konten Dropdown Menu -->
                <!-- x-show="open" memastikan menu hanya tampil jika 'open' adalah true -->
                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="absolute right-0 top-16 w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 p-2">
                    <!-- Tautan Profil -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil
                    </a>
                    <!-- Tautan Tentang -->
                    <a href="{{ route('tentang') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang
                    </a>
                    <!-- Tombol Keluar -->
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
</body>
</html>
