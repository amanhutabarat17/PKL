{{-- @extends('layouts.app') --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penugasan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Pastikan Tailwind aktif --}}
</head>
<body class="bg-gray-950 text-white font-sans">

    @include('layouts.navigation')

    {{-- Konten Utama --}}
    <main class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Daftar Penugasan Karyawan</h2>
            <a href="{{ route('penugasan.create') }}" class="p-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition transform hover:scale-110" aria-label="Tambah Penugasan">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

        {{-- Pencarian --}}
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Cari penugasan..." class="w-full px-4 py-3 border border-gray-700 rounded-xl bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        </div>

        {{-- Tabel --}}
        <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-300" id="penugasanTable">
                    <thead class="bg-gray-800 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Nama petugas</th>
                            <th class="px-6 py-3">Kecamatan</th>
                            <th class="px-6 py-3">Alamat Lengkap</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($penugasans as $index => $penugasan)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $penugasan->nama_karyawan }}</td>
                                <td class="px-6 py-4">{{ $penugasan->kecamatan->nama_kecamatan }}</td>
                                <td class="px-6 py-4">{{ $penugasan->alamat_lengkap }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('penugasan.edit', $penugasan->id) }}" class="text-blue-400 hover:text-blue-600 font-semibold">Edit</a>
                                    <form action="{{ route('penugasan.destroy', $penugasan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">Tidak ada data penugasan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- Script Pencarian --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#penugasanTable tbody tr');

            searchInput.addEventListener('input', function () {
                const searchText = this.value.toLowerCase();
                tableRows.forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(searchText) ? '' : 'none';
                });
            });
        });
    </script>

</body>
</html>