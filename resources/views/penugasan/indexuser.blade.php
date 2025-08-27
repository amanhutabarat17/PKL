<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penugasan</title>
    
    <!-- Mengimpor font Inter dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Mengimpor Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mendefinisikan variabel CSS untuk warna BPJS */
        :root {
            --bpjs-dark-green: #1f8d5fff;
            --bpjs-light-green: #009944;
            --bpjs-text-color-light: #4a5568;
            --bpjs-bg-light-1: #ddffebff;
            --bpjs-bg-light-2: #edf2f7;
            --bpjs-border-color: #cbd5e0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bpjs-bg-light-1); /* Latar belakang terang */
            min-height: 100vh;
            color: var(--bpjs-text-color-light); /* Warna teks gelap */
        }

        .container {
            max-width: 1024px;
            margin: auto;
            padding: 2rem;
        }

        /* Tombol utama dengan warna hijau BPJS */
        .btn-primary {
            background: var(--bpjs-light-green);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: transform 0.2s, background-color 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background-color: var(--bpjs-dark-green);
        }

        /* Gaya untuk tombol tambah (ikon) */
        .btn-icon {
            background: var(--bpjs-light-green);
            color: white;
            border-radius: 9999px; /* Rounded full */
            padding: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 153, 68, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 20px 25px -5px rgba(0, 153, 68, 0.4);
        }
        
        .input-search {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--bpjs-border-color);
            border-radius: 0.5rem;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: white; /* Warna latar belakang input terang */
            color: var(--bpjs-text-color-light);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .input-search:focus {
            border-color: var(--bpjs-light-green);
            box-shadow: 0 0 0 4px rgba(0, 153, 68, 0.2);
        }
        
        .table-container {
            background-color: white; /* Latar belakang tabel putih */
            border-radius: 1rem;
            box-shadow: 0 10px 30px -5px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        .table-header th {
            background-color: var(--bpjs-dark-green); /* Header hijau tua */
            color: white;
            padding: 1rem 1.5rem;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .table-body tr {
            transition: background-color 0.2s;
        }

        .table-body tr:hover {
            background-color: #5d986bff; /* Efek hover hijau muda */
        }

        .table-body td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--bpjs-border-color);
            color: #2d3748;
        }

        .link-aksi {
            font-weight: 600;
            transition: color 0.2s;
        }

        .link-edit {
            color: var(--bpjs-light-green);
        }
        .link-edit:hover {
            color: var(--bpjs-dark-green);
        }

        .link-delete {
            color: #DC2626; /* Warna merah untuk aksi hapus */
        }
        .link-delete:hover {
            color: #B91C1C;
        }
    </style>
</head>
<body class="font-sans">

    {{-- Navigasi --}}
    @include('layouts.navigation')

    {{-- Konten Utama --}}
    <main class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Daftar Penugasan Karyawan</h2>
            <a href="{{ route('penugasan.create') }}" class="btn-icon" aria-label="Tambah Penugasan">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

        {{-- Pencarian --}}
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Cari penugasan..." class="input-search">
        </div>

        {{-- Tabel --}}
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left" id="penugasanTable">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Nama petugas</th>
                            <th class="px-6 py-3">Kecamatan</th>
                            <th class="px-6 py-3">Alamat Lengkap</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @forelse ($penugasans as $index => $penugasan)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $penugasan->nama_karyawan }}</td>
                                <td class="px-6 py-4">{{ $penugasan->kecamatan->nama_kecamatan }}</td>
                                <td class="px-6 py-4">{{ $penugasan->alamat_lengkap }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('penugasan.edit', $penugasan->id) }}" class="link-aksi link-edit">Edit</a>
                                    <form action="{{ route('penugasan.destroy', $penugasan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link-aksi link-delete">Hapus</button>
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
                    // Pastikan baris "Tidak ada data" tidak ikut disembunyikan
                    if (row.querySelector('td[colspan]')) {
                        row.style.display = 'none';
                        return;
                    }
                    row.style.display = row.textContent.toLowerCase().includes(searchText) ? '' : 'none';
                });
            });
        });
    </script>

</body>
</html>
