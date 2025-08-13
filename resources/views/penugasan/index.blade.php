@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-white">Daftar Penugasan Karyawan</h1>
        {{-- Ikon 'Tambah Penugasan' dengan tautan --}}
        <a href="{{ route('penugasan.create') }}" class="p-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition duration-300 transform hover:scale-110" aria-label="Tambah Penugasan">
            {{-- Menggunakan SVG sederhana untuk ikon tambah --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    </div>

    {{-- Kolom pencarian di atas tabel --}}
    <div class="mb-4">
        <input type="text" id="searchInput" placeholder="Cari penugasan..." class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200">
    </div>

    {{-- Tabel Penugasan --}}
    <div class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden">
        <h2 class="text-xl font-bold text-white px-6 py-4">Tabel Penugasan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-gray-300" id="penugasanTable">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left font-bold text-sm uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left font-bold text-sm uppercase tracking-wider">Nama Karyawan</th>
                        <th class="px-6 py-3 text-left font-bold text-sm uppercase tracking-wider">Kecamatan</th>
                        <th class="px-6 py-3 text-left font-bold text-sm uppercase tracking-wider">Alamat Lengkap</th>
                        <th class="px-6 py-3 text-left font-bold text-sm uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    {{-- Loop data penugasan --}}
                    @forelse ($penugasans as $index => $penugasan)
                        <tr class="hover:bg-gray-800 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap nama_karyawan">{{ $penugasan->nama_karyawan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap kecamatan">{{ $penugasan->kecamatan->nama_kecamatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap alamat_lengkap">{{ $penugasan->alamat_lengkap }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('penugasan.edit', $penugasan->id) }}" class="text-blue-400 hover:text-blue-600 font-semibold mr-4">Edit</a>
                                <form action="{{ route('penugasan.destroy', $penugasan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">Tidak ada data penugasan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#penugasanTable tbody tr');

        searchInput.addEventListener('keyup', function (e) {
            const searchText = e.target.value.toLowerCase();

            tableRows.forEach(row => {
                const rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchText)) {
                    row.style.display = ''; // Tampilkan baris jika cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            });
        });
    });
</script>
@endpush
