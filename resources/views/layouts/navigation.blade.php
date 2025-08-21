@vite('resources/css/app.css')
@vite('resources/js/app.js')
<nav class="w-full bg-gradient-to-r from-sky-500 via-green-500 to-green-600 shadow-md">
    <div class="flex justify-between items-center h-16 px-6">

        <!-- Logo -->
        <h1 class="flex items-center gap-3">
            <img src="{{ asset('gambar/logoo.png') }}" alt="Logo BPJS" class="w-40 h-auto drop-shadow-lg">
        </h1>

        <!-- Profile + Dropdown -->
        <div x-data="{ open: false }" class="relative flex items-center">
            <!-- Foto Profil -->
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                alt="Foto Profil" class="w-10 h-10 rounded-full border-2 border-white shadow-md mr-2">

            <!-- Tombol Trigger -->
            <button @click="open = !open"
        class="flex items-center gap-1 bg-blue-100 text-gray-800 text-sm font-medium px-3 py-1.5 rounded-md shadow hover:bg-blue-200 transition">
   <!-- {{ Auth::user()->name }} --> Menu
    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" 
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 
                 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 
                 010-1.414z" 
              clip-rule="evenodd" />
    </svg>
</button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 top-14 w-48 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 z-50">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                    📊 Beranda
                </a>
                <a href="{{ route('penugasan.index') }}"
                    class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                    📝 Penugasan
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                    👤 Profil
                </a>
                <a href="{{ route('tentang') }}"
                    class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                    ℹ️ Tentang
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-2 px-4 py-2 text-red-600 hover:bg-gray-100">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>