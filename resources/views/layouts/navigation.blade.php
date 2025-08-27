<!DOCTYPE html>
<html lang="id" x-data="{ navOpen: false, profileOpen: false }">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Responsive</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Alpine.js -->
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
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50">

  <!-- Navbar -->
  <nav class="w-full bg-gradient-to-r from-sky-500 via-green-500 to-green-600 shadow-2xl z-50">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-12">

      <!-- Desktop Navbar -->
      <div class="hidden lg:flex justify-between items-center h-20">
        <!-- Logo -->
        <div class="flex items-center gap-10">
          <img src="{{ asset('gambar/logoo.png') }}" alt="Logo BPJS" class="w-40 h-auto drop-shadow-lg">
          <!-- Navigation Links -->
          <div class="flex gap-4">
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
          </div>
        </div>

        <!-- Profile & Dropdown -->
        <div x-data="{ profileOpen: false }" class="relative flex items-center gap-4">
          <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
            alt="Foto Profil" class="w-14 h-14 rounded-full border-4 border-white shadow-xl hover:scale-105 transition">
          <span class="text-white font-medium text-lg hidden md:block">{{ Auth::user()->name }}</span>
          <button @click="profileOpen = !profileOpen"
            class="flex items-center gap-2 bg-white text-green-800 text-base font-semibold px-4 py-2 rounded-full shadow-lg hover:bg-gray-100 transition">
            <span>Menu</span>
            <svg class="w-4 h-4 text-green-800 transition-transform duration-200"
              :class="profileOpen ? 'rotate-180' : 'rotate-0'" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <div x-show="profileOpen" @click.away="profileOpen = false" x-transition
            class="absolute right-0 top-16 w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 p-2">
            <a href="{{ route('profile.edit') }}"
              class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Profil</a>
            <a href="{{ route('tentang') }}"
              class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Tentang</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded">Keluar</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Mobile Navbar -->
      <div class="lg:hidden py-4" x-data="{ navOpen: false }">
        <div class="flex justify-between items-center">
          <img src="{{ asset('gambar/logoo.png') }}" alt="Logo BPJS" class="w-32 h-auto drop-shadow-lg">
          <button @click="navOpen = !navOpen" class="text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="navOpen" x-transition class="mt-4 space-y-2">
          <a href="{{ route('bpjs.ketenagakerjaan') }}"
            class="block text-white font-medium px-4 py-2 bg-green-700 rounded">BPJS Ketenagakerjaan</a>
          <a href="{{ route('dashboard') }}"
            class="block text-white font-medium px-4 py-2 bg-green-700 rounded">Beranda</a>
          <a href="{{ route('penugasan.index') }}"
            class="block text-white font-medium px-4 py-2 bg-green-700 rounded">Penugasan</a>

          <!-- Mobile Profile -->
          <div class="border-t border-white pt-2">
            <div class="flex items-center gap-3 px-4">
              <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                alt="Foto Profil" class="w-10 h-10 rounded-full border-2 border-white shadow">
              <span class="text-white font-medium">{{ Auth::user()->name }}</span>
            </div>
            <a href="{{ route('profile.edit') }}"
              class="block px-4 py-2 text-white hover:bg-green-600 rounded">Profil</a>
            <a href="{{ route('tentang') }}"
              class="block px-4 py-2 text-white hover:bg-green-600 rounded">Tentang</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="w-full text-left px-4 py-2 text-red-200 hover:bg-red-600 hover:text-white rounded">Keluar</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </nav>

</body>

</html>