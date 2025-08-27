<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #e0f2f1, #c8e6c9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .profile-card {
            background: linear-gradient(to bottom, #bfd8b8ff, #f0fdf4);
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .btn-bpjs {
            background: linear-gradient(to right, #008080, #009944);
            color: white;
            transition: background 0.3s ease;
        }
        .btn-bpjs:hover {
            background: linear-gradient(to right, #005f5f, #007739);
        }
    </style>
</head>
<body class="antialiased">
    <div class="max-w-xl w-full mx-auto p-8 profile-card">

        <header class="mb-8 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-2">
                Informasi Profil
            </h2>
            <p class="mt-2 text-md text-gray-500">
                Perbarui nama, alamat email, dan foto profil akun Anda.
            </p>
        </header>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            @if (session('status') === 'profile-updated')
                <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-md shadow-sm transition-all duration-300 ease-in-out transform scale-100" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline"> Profil Anda berhasil diperbarui.</span>
                </div>
            @endif

            <div class="flex flex-col items-center gap-4">
                <img id="avatar-preview" class="w-32 h-32 rounded-full object-cover shadow-lg border-2 border-[#009944]"
                     src="{{ $user->avatar ? asset($user->avatar) : 'https://placehold.co/128x128/a7a7a7/ffffff?text=User' }}"
                     alt="Foto Profil">
                <label class="cursor-pointer bg-[#008080] hover:bg-[#005f5f] text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                    <span>Unggah Foto</span>
                    <input type="file" name="avatar" id="avatar-input" class="hidden" onchange="previewImage(event)">
                </label>
                @error('avatar')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input id="name" name="name" type="text" class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-[#009944] focus:ring-[#009944] transition duration-150 ease-in-out px-4 py-2" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-[#009944] focus:ring-[#009944] transition duration-150 ease-in-out px-4 py-2" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <!-- Logika dinamis untuk tombol kembali -->
                <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('dashboarduser') }}"
                   class="inline-flex items-center btn-bpjs hover:bg-[#005f5f] text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

                <button type="submit" class="btn-bpjs hover:bg-[#005f5f] text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    
    <script>
        /**
         * Fungsi untuk menampilkan pratinjau gambar yang dipilih oleh pengguna.
         * @param {Event} event - Objek event dari input file.
         */
        function previewImage(event) {
            const avatarPreview = document.getElementById('avatar-preview');
            const file = event.target.files && event.target.files.length > 0 ? event.target.files[0] : null;
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
