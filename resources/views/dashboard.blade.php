<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BPJS Ketenagakerjaan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@heroicons/2.1.3/dist/24/outline/index.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            /* Gaya khusus untuk sidebar */
            transition: all 0.3s ease-in-out;
            width: 256px; /* Lebar default untuk desktop */
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0; /* Sembunyikan sidebar di mobile */
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-slate-900 text-white min-h-screen">
    
    <div class="flex flex-col md:flex-row h-screen">

        <aside class="sidebar bg-slate-800 p-6 shadow-lg md:flex-shrink-0 md:relative fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 z-50">
            <div class="flex items-center space-x-3 mb-8">
                <span class="text-2xl font-bold">BPJS</span>
            </div>
            
            <nav>
                <ul>
                    <li class="mb-4">
                        <a href="#" class="flex items-center space-x-3 text-lg font-medium text-blue-400 bg-slate-700 p-3 rounded-xl transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('penugasan.index') }}" class="flex items-center space-x-3 text-lg font-medium text-slate-400 hover:text-blue-400 p-3 rounded-xl transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Penjadwalan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="flex-grow bg-slate-900 p-6 md:p-8 overflow-y-auto">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">Dashboard</h1>
                
                <div class="relative flex items-center space-x-2" id="dropdown-wrapper">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto Profil" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <div class="h-10 w-10 rounded-full bg-slate-700 flex items-center justify-center text-slate-400 font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif

                    <button id="dropdown-toggle" class="flex items-center space-x-2 text-slate-300 hover:text-white transition-colors duration-200">
                        <span>{{ $user->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="dropdown-menu" class="absolute right-0 top-12 mt-2 w-48 bg-slate-800 rounded-md shadow-lg py-1 z-10 hidden transition-all duration-200">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-slate-300 hover:bg-slate-700">Profil</a>
                        <a href="{{ route('tentang') }}" class="block px-4 py-2 text-slate-300 hover:bg-slate-700">Tentang</a>
                        <a href="{{ route('keluar') }}" class="block px-4 py-2 text-slate-300 hover:bg-slate-700">Keluar</a>
                    </div>
                </div>

            </header>

            <div x-data="{ show: true }" x-show="show" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-700">
                    <p class="text-slate-300 text-lg">Anda telah berhasil login!</p>
                    <button @click="show = false" class="mt-4 px-4 py-2 bg-slate-600 text-white rounded">Tutup</button>
                </div>
            </div>
            <h2>Selamat datang, {{ $user->name }}</h2>

            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        @foreach($header as $col)
                            <th>{{ $col }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            @foreach($row['data'] as $i => $cell)
                                <td style="background-color: {{ isset($row['colors'][$i]) ? $row['colors'][$i] : '' }}">
                                    {{ $cell }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </main>
        <script>
            const toggle = document.getElementById('dropdown-toggle');
            const menu = document.getElementById('dropdown-menu');

            toggle.addEventListener('click', (e) => {
                e.stopPropagation(); // biar gak langsung nutup
                menu.classList.toggle('hidden');
            });

            // Tutup dropdown kalau klik di luar
            document.addEventListener('click', (e) => {
                const dropdownWrapper = document.getElementById('dropdown-wrapper');
                if (dropdownWrapper && !dropdownWrapper.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
    </div>
</body>
</html>