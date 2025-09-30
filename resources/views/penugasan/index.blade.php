<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penugasan Karyawan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* RESET FONT & BASE STYLING */
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f7fbfd; /* Light Blue/Gray Background */ 
            min-height: 100vh; 
            color: #374151; 
        }
        .container { 
            max-width: 1400px; /* Lebih lebar */
            margin: auto; 
            padding: 2rem; 
        }
        
        /* HEADER & BUTTONS (Emerald Green Theme) */
        .btn-icon { 
            background: #10b981; /* Emerald Green */
            color: white; 
            border-radius: 9999px; 
            padding: 0.75rem; 
            box-shadow: 0 5px 15px -3px rgba(16, 185, 129, 0.4); 
            transition: transform 0.2s, box-shadow 0.2s; 
        }
        .btn-icon:hover { 
            transform: scale(1.05); 
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.6); 
            background: #059669;
        }
        
        /* SEARCH INPUT */
        .input-search { 
            width: 100%; 
            padding: 0.75rem 1rem; 
            border: 1px solid #d1d5db; 
            border-radius: 0.75rem; /* Lebih bulat */
            outline: none; 
            transition: border-color 0.3s, box-shadow 0.3s; 
            background-color: white; 
            color: #1f2937; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); 
        }
        .input-search:focus { 
            border-color: #10b981; 
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3); 
        }
        
        /* TABLE STYLING */
        .table-container { 
            background-color: white; 
            border-radius: 1rem; 
            box-shadow: 0 15px 30px -10px rgba(0,0,0,0.15); 
            overflow-x: auto; 
        }
        .table-header th { 
            background-color: #065f46; /* Darker Emerald */ 
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
            background-color: #f0fdfa; /* Very light green on hover */
        }
        .table-body td { 
            padding: 1rem 1.5rem; 
            border-bottom: 1px solid #f3f4f6; 
            color: #374151; 
            vertical-align: middle; 
        }
        
        /* ACTION LINKS/BUTTONS */
        .link-aksi { 
            font-weight: 600; 
            transition: color 0.2s, background-color 0.2s; 
            padding: 4px 8px;
            border-radius: 0.5rem;
            text-decoration: none; 
        }
        .link-edit { 
            color: #059669; 
            background-color: #ecfdf5; /* Light green background */
        }
        .link-edit:hover { 
            color: white; 
            background-color: #059669; 
        }
        .link-delete { 
            color: #dc2626; /* Red 600 */
            background-color: #fef2f2; /* Light red background */
            display: inline-block;
            border: none; /* Penting untuk tombol form */
            cursor: pointer;
        }
        .link-delete:hover { 
            color: white; 
            background-color: #dc2626; 
        }
        
        /* IMAGE STYLING */
        .table-body td img {
            width: 80px;
            height: 80px;
            border: 2px solid #e5e7eb;
            transition: transform 0.2s;
        }
        .table-body td img:hover {
            transform: scale(1.05);
        }

        /* --- ALERT/TOAST STYLING --- */
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 1rem;
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); /* Bounce effect */
        }
        .custom-alert.show {
            transform: translateX(0);
        }
        .custom-alert-success {
            background-color: #d1fae5; 
            border-left: 5px solid #10b981; 
            color: #065f46; 
        }
        .custom-alert-success .icon {
            color: #10b981;
        }
        .custom-alert-error {
            background-color: #fee2e2; 
            border-left: 5px solid #ef4444; 
            color: #991b1b; 
        }
        .custom-alert-error .icon {
            color: #ef4444;
        }
        .custom-alert-message strong {
            font-weight: 700;
            font-size: 1.1em;
        }
        .custom-alert .close-btn {
            background: none;
            border: none;
            color: inherit;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            margin-left: auto;
        }
    </style>
</head>
<body class="font-sans">

    {{-- Asumsi: Anda memiliki layout/navigation.blade.php yang di-include di sini --}}
    @include('layouts.navigation') 

    {{-- Menggunakan session untuk menampilkan pesan yang dikirim dari controller --}}
    @if(session('success'))
        <div id="alert-success" class="custom-alert custom-alert-success">
            <span class="icon"><i class="fas fa-check-circle fa-lg"></i></span>
            <div class="custom-alert-message">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button class="close-btn" onclick="closeAlert('alert-success')"><i class="fas fa-times"></i></button>
        </div>
    @endif

    @if(session('error'))
        <div id="alert-error" class="custom-alert custom-alert-error">
            <span class="icon"><i class="fas fa-exclamation-circle fa-lg"></i></span>
            <div class="custom-alert-message">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
            <button class="close-btn" onclick="closeAlert('alert-error')"><i class="fas fa-times"></i></button>
        </div>
    @endif
    
    <main class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">Daftar Penugasan Karyawan</h2>
            <a href="{{ route('penugasan.create') }}" class="btn-icon" aria-label="Tambah Penugasan">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Cari nama petugas, kabupaten, atau deskripsi..." class="input-search">
        </div>

        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left" id="penugasanTable">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Nama Petugas</th>
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
                                        {{-- Gunakan fungsi basename untuk mendapatkan nama file saja --}}
                                        <img src="{{ route('storage.image', ['folder' => basename(dirname($penugasan->photo_path)), 'filename' => basename($penugasan->photo_path)]) }}" 
                                             alt="Foto Penugasan" 
                                             class="w-20 h-20 rounded-lg object-cover shadow-md">
                                    @else
                                        <img src="https://placehold.co/80x80/f3f4f6/6b7280?text=No+Image" 
                                             alt="Tidak ada foto" 
                                             class="w-20 h-20 rounded-lg object-cover">
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-xs whitespace-normal text-gray-500">
                                    {{-- Menggunakan Str::limit untuk mencegah kolom terlalu lebar --}}
                                    {{ Illuminate\Support\Str::limit($penugasan->deskripsi, 50, '...') }}
                                </td>
                                <td class="px-6 py-4">{{ optional(optional($penugasan->kecamatan)->kabupaten)->nama_kabupaten ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ optional($penugasan->kecamatan)->nama_kecamatan ?? 'N/A' }}</td>
                                <td class="px-6 py-4 max-w-xs text-gray-500">
                                    {{ Illuminate\Support\Str::limit($penugasan->alamat_lengkap, 50, '...') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <a href="{{ route('penugasan.edit', $penugasan->id) }}" class="link-aksi link-edit">Edit</a>
                                        <form action="{{ route('penugasan.destroy', $penugasan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data penugasan ini secara permanen?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            {{-- Tombol Hapus dengan styling baru --}}
                                            <button type="submit" class="link-aksi link-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-400">
                                    <i class="fas fa-box-open fa-2x mb-3"></i><br>
                                    Belum ada data penugasan yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>

<script>
    // FUNGSI UNTUK ALERT/TOAST
    document.addEventListener('DOMContentLoaded', (event) => {
        // Tampilkan alert jika ada
        const successAlert = document.getElementById('alert-success');
        const errorAlert = document.getElementById('alert-error');

        if (successAlert) {
            // Tampilkan dengan sedikit jeda untuk animasi
            setTimeout(() => {
                successAlert.classList.add('show');
            }, 100);
            // Sembunyikan otomatis setelah 5 detik
            setTimeout(() => {
                successAlert.classList.remove('show');
            }, 5000); 
        }
        
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.add('show');
            }, 100);
            // Sembunyikan otomatis setelah 7 detik
            setTimeout(() => {
                errorAlert.classList.remove('show');
            }, 7000); 
        }
    });

    // Fungsi untuk menutup alert secara manual
    function closeAlert(id) {
        document.getElementById(id).classList.remove('show');
    }
    
    // FUNGSI SEARCH 
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#penugasanTable tbody tr");

        rows.forEach(row => {
            // Mengambil semua teks dalam baris
            let text = row.textContent.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = "";
            } else {    
                row.style.display = "none";
            }
        });
    });
</script>

</body>
</html>