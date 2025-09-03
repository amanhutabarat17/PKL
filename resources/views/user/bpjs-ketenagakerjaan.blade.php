<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri BPJS Ketenagakerjaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            background-color: #f3f4f6;
        }

        /* Kelas kustom untuk bayangan yang lebih kuat dan berkelas */
        .shadow-custom {
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.1), 0 10px 10px -5px rgba(16, 185, 129, 0.04);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 to-teal-50 min-h-screen antialiased">

    <nav x-data="{ menuOpen: false }" class="w-full bg-gradient-to-r from-teal-500 to-emerald-600 shadow-2xl shadow-green-600/50 z-50 fixed top-0">
        <div class="relative flex justify-between items-center h-20 px-4 md:px-8 lg:px-12">
            <div class="flex items-center gap-10">
                <h1 class="flex items-center">
                    <img src="{{ asset('gambar/BPJS.png') }}" alt="Logo BPJS" class="w-52 h-auto drop-shadow-lg">
                </h1>
                <div class="hidden lg:flex gap-6">
                    <a href="{{ route('bpjs.ketenagakerjaanuser') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:text-green-600 shadow-xl">
                        BPJS Ketenagakerjaan
                    </a>
                    <a href="{{ route('dashboarduser') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:text-green-600 shadow-xl">
                        Beranda
                    </a>
                    <a href="{{ route('penugasanuser') }}"
                        class="text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:text-green-600 shadow-xl">
                        Penugasan
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div x-data="{ open: false }" class="relative items-center gap-4 hidden lg:flex">
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        alt="Foto Profil" class="w-14 h-14 rounded-full border-4 border-white shadow-xl">
                    <span class="text-white font-medium text-lg hidden md:block">{{ Auth::user()->name }}</span>
                    <button @click="open = !open"
                        class="flex items-center gap-2 bg-white text-green-800 text-base font-semibold px-4 py-2 rounded-full shadow-lg shadow-green-500/50 hover:bg-gray-100 transition-all duration-200">
                        <span>Menu</span>
                        <svg class="w-4 h-4 text-green-800 transition-transform duration-200"
                            :class="open ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil
                        </a>
                        <a href="{{ route('tentang') }}"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tentang
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition duration-150 ease-in-out">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex items-center gap-4 lg:hidden">
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        alt="Foto Profil" class="w-10 h-10 rounded-full border-2 border-white shadow-xl">
                    <button @click="menuOpen = !menuOpen" type="button" class="text-white hover:text-gray-200 focus:outline-none focus:text-gray-200">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="menuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-y-0 origin-top"
            x-transition:enter-end="opacity-100 transform scale-y-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-y-100"
            x-transition:leave-end="opacity-0 transform scale-y-0 origin-top"
            class="absolute top-full right-0 mt-1 lg:hidden w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 p-2">
            
            <div @click.away="menuOpen = false" class="flex flex-col">
                <a href="{{ route('bpjs.ketenagakerjaanuser') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    BPJS Ketenagakerjaan
                </a>
                <a href="{{ route('dashboarduser') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    Beranda
                </a>
                <a href="{{ route('penugasanuser') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    Penugasan
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil
                </a>
                <a href="{{ route('tentang') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="pt-24"></div>

    <div class="container mx-auto p-4 sm:p-8">
        <div class="bg-white rounded-3xl shadow-custom p-6 sm:p-10 my-8 border border-gray-200">
            <div class="flex flex-col items-center justify-center mb-6">
                <img src="{{ asset('gambar/BPJS.png') }}" alt="Logo BPJS Ketenagakerjaan" class="w-80 sm:w-96 h-auto mb-4 drop-shadow-lg">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-center text-emerald-700 drop-shadow-md">
                    Galeri BPJS Ketenagakerjaan
                </h1>
            </div>
            <p class="text-lg sm:text-xl text-gray-700 text-center leading-relaxed">
                Temukan foto-foto kegiatan BPJS Ketenagakerjaan di sini.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-custom p-6 sm:p-8 my-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                Galeri Foto
            </h2>
            @if(count($photos) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($photos as $photo)
                        <div class="relative w-full overflow-hidden rounded-2xl shadow-xl transform transition-all duration-500 hover:scale-105 group border border-gray-200">
                            <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->description }}" class="w-full h-56 object-cover rounded-2xl">
                            
                            <div class="p-4 bg-white bg-opacity-95 rounded-b-2xl transition-all duration-500 group-hover:bg-white group-hover:bg-opacity-100">
                                <p class="font-semibold text-gray-800">{{ $photo->description ?? 'Tidak ada deskripsi' }}</p>
                                <p class="text-sm text-gray-500 mt-1">Diunggah: {{ $photo->created_at->format('d M Y') }}</p>
                            </div>
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