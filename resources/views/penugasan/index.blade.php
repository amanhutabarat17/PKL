<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Penugasan</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            :root {
                --bpjs-dark-green: #1f8d5fff;
                --bpjs-light-green: #009944;
                --bpjs-text-color-light: #4a5568;
                --bpjs-bg-light-1: #ddffebff;
                --bpjs-bg-light-2: #edf2f7;
                --bpjs-border-color: #cbd5e0;
            }
            body { font-family: 'Inter', sans-serif; background-color: var(--bpjs-bg-light-1); min-height: 100vh; color: var(--bpjs-text-color-light); }
            .container { max-width: 1280px; margin: auto; padding: 2rem; }
            .btn-icon { background: var(--bpjs-light-green); color: white; border-radius: 9999px; padding: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 153, 68, 0.3); transition: transform 0.2s, box-shadow 0.2s; }
            .btn-icon:hover { transform: scale(1.1); box-shadow: 0 20px 25px -5px rgba(0, 153, 68, 0.4); }
            .input-search { width: 100%; padding: 0.75rem 1rem; border: 2px solid var(--bpjs-border-color); border-radius: 0.5rem; outline: none; transition: border-color 0.3s, box-shadow 0.3s; background-color: white; color: var(--bpjs-text-color-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
            .input-search:focus { border-color: var(--bpjs-light-green); box-shadow: 0 0 0 4px rgba(0, 153, 68, 0.2); }
            .table-container { background-color: white; border-radius: 1rem; box-shadow: 0 10px 30px -5px rgba(0,0,0,0.1); overflow-x: auto; }
            .table-header th { background-color: var(--bpjs-dark-green); color: white; padding: 1rem 1.5rem; text-align: left; text-transform: uppercase; font-size: 0.75rem; font-weight: 700; }
            .table-body tr { transition: background-color 0.2s; }
            .table-body tr:hover { background-color: #f0fdf4; }
            .table-body td { padding: 1rem 1.5rem; border-bottom: 1px solid var(--bpjs-border-color); color: #2d3748; vertical-align: middle; }
            .link-aksi { font-weight: 600; transition: color 0.2s; }
            .link-edit { color: var(--bpjs-light-green); }
            .link-edit:hover { color: var(--bpjs-dark-green); }
            .link-delete { color: #DC2626; }
            .link-delete:hover { color: #B91C1C; }
        </style>
    </head>
    <body class="font-sans">

        @include('layouts.navigation')

        <main class="container mx-auto px-6 py-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Daftar Penugasan Karyawan</h2>
                <a href="{{ route('penugasan.create') }}" class="btn-icon" aria-label="Tambah Penugasan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </a>
            </div>

            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Cari penugasan..." class="input-search">
            </div>

            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left" id="penugasanTable">
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Nama petugas</th>
                                <th class="px-6 py-3">Foto</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3">Kabupaten</th>
                                <th class="px-6 py-3">Kecamatan</th>
                                <th class="px-6 py-3">Alamat Lengkap</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @forelse ($penugasans as $index => $penugasan)
                                <tr class="transition">
                                    <td class="px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $penugasan->nama_karyawan }}</td>
                                    <td class="px-6 py-4">
                                        @if ($penugasan->photo_path)
                                            {{-- Ukuran diubah dari w-20 h-20 menjadi w-24 h-24 --}}
                                            <img src="{{ route('storage.image', ['filename' => basename($penugasan->photo_path)]) }}" alt="" class="w-30 h-30 rounded-lg object-cover shadow-md">
                                        @else
                                            {{-- Ukuran diubah dari w-20 h-20 menjadi w-24 h-24 --}}
                                            <img src="https://placehold.co/100x100/e2e8f0/333?text=No+Image" alt="Tidak ada foto" class="w-24 h-24 rounded-lg object-cover">
                                        @endif
                                    </td>
                                    <!-- PERUBAHAN DESKRIPSI DI SINI -->
                                    <td class="px-6 py-4 max-w-sm whitespace-normal">
                                        {{ $penugasan->deskripsi }}
                                    </td>
                                    <td class="px-6 py-4">{{ optional(optional($penugasan->kecamatan)->kabupaten)->nama_kabupaten ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ optional($penugasan->kecamatan)->nama_kecamatan ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $penugasan->alamat_lengkap }}</td>
                                    <!-- PERUBAHAN AKSI DI SINI -->
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex gap-2 justify-center items-center">
                                            <a href="{{ route('penugasan.edit', $penugasan->id) }}" class="link-aksi link-edit">Edit</a>
                                            <form action="{{ route('penugasan.destroy', $penugasan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="link-aksi link-delete bg-transparent border-none p-0 cursor-pointer">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-400">Tidak ada data penugasan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <script>
            // Script tidak diubah
        </script>

    </body>
    </html>

index