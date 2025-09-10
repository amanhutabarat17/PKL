<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Navigation Bar</title>
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
        }

        /* CSS untuk ikon hamburger dan animasinya */
        .hamburger-icon span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #1e40af;
            /* Biru gelap */
            border-radius: 9999px;
            transition: all 0.3s ease-in-out;
        }

        .hamburger-icon span:nth-child(2) {
            margin: 5px 0;
        }

        .hamburger-icon.open span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger-icon.open span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-icon.open span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* Peningkatan untuk dropdown menu mobile */
        .mobile-dropdown {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 0.5rem;
        }

        .mobile-dropdown a {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.15s ease-in-out;
        }

        .mobile-dropdown a:hover {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body>
    <nav class="w-full bg-gradient-to-r from-sky-500 via-green-500 to-green-600 shadow-2xl shadow-green-600/50 z-50">
        <div class="flex justify-between items-center h-20 px-8 lg:px-12">
            <div class="flex items-center gap-10">
                <h1 class="flex items-center">
                    <img src="{{ asset('gambar/logoo.png') }}" alt="Logo BPJS" class="w-40 h-auto drop-shadow-lg">
                </h1>

                <div class="hidden lg:flex gap-4">
                    {{-- Navigasi untuk Admin --}}
                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('bpjs.ketenagakerjaan') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">BPJS Ketenagakerjaan</span>
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Beranda</span>
                    </a>
                    <a href="{{ route('penugasan.index') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Penugasan</span>
                    </a>
                    {{-- Navigasi untuk CS --}}
                    @elseif(Auth::check() && Auth::user()->role === 'cs')
                    <a href="{{ route('bpjs.ketenagakerjaancs') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">BPJS Ketenagakerjaan</span>
                    </a>
                    <a href="{{ route('dashboardcs') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Beranda</span>
                    </a>
                    {{-- Navigasi untuk User Biasa --}}
                    @else
                    <a href="{{ route('bpjs.ketenagakerjaanuser') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">BPJS Ketenagakerjaan</span>
                    </a>
                    <a href="{{ route('dashboarduser') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Beranda</span>
                    </a>
                    <a href="{{ route('penugasanuser') }}"
                        class="group text-white font-semibold text-lg px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white shadow-xl">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Penugasan</span>
                    </a>
                    @endif
                </div>
            </div>

            <div x-data="{ open: false }" class="relative flex items-center gap-4">
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="Foto Profil" class="w-14 h-14 rounded-full border-4 border-white shadow-xl">
                <span class="text-white font-medium text-lg hidden md:block">{{ Auth::user()->name }}</span>

                {{-- Tombol Dropdown untuk Desktop --}}
                <button @click="open = !open"
                    class="hidden lg:flex items-center gap-2 bg-white text-green-800 text-base font-semibold px-4 py-2 rounded-full shadow-lg shadow-green-500/50 hover:bg-gray-100 transition-all duration-200">
                    <span>Menu</span>
                    <svg class="w-4 h-4 text-green-800 transition-transform duration-200"
                        :class="open ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Tombol Hamburger untuk Mobile --}}
                <button @click="open = !open" aria-label="Toggle mobile menu"
                    class="flex items-center justify-center w-12 h-12 bg-white text-green-800 rounded-full shadow-lg shadow-green-500/50 hover:bg-gray-100 transition-all duration-200 lg:hidden">
                    <div class="hamburger-icon" :class="{ 'open': open }">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="absolute right-0 top-16 w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 p-2 mobile-dropdown">
                    
                    {{-- Nav Links for Mobile (visible only on mobile) --}}
                    <div class="lg:hidden mb-2 border-b border-gray-200 pb-2">
                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('bpjs.ketenagakerjaan') }}"
                            class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">BPJS Ketenagakerjaan</a>
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">Dashboard</a>
                        <a href="{{ route('penugasan.index') }}"
                            class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">Penugasan</a>
                        @else
                        <a href="{{ route('bpjs.ketenagakerjaanuser') }}"
                            class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">BPJS Ketenagakerjaan</a>
                        <a href="{{ route('dashboarduser') }}"
                            class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">Dashboard</a>
                        <a href="{{ route('penugasanuser') }}"
                            class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 ease-in-out">Penugasan</a>
                        @endif
                    </div>
                    
                    {{-- Common Dropdown Items for both desktop and mobile --}}
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
</body>

</html>