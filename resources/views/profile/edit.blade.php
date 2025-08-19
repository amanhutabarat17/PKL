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
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen p-4">
    <div class="max-w-xl w-full mx-auto p-8 bg-white rounded-2xl shadow-xl border border-gray-200">

        <!-- Header Halaman -->
        <header class="mb-8 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-2">
                Informasi Profil
            </h2>
            <p class="mt-2 text-md text-gray-500">
                Perbarui nama, alamat email, dan foto profil akun Anda.
            </p>
        </header>

        <!-- Formulir Pembaruan Profil -->
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            <!-- Notifikasi Sukses -->
            @if (session('status') === 'profile-updated')
                <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-md shadow-sm transition-all duration-300 ease-in-out transform scale-100" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline"> Profil Anda berhasil diperbarui.</span>
                </div>
            @endif

            <!-- Bagian Unggah Foto Profil -->
            <div class="flex flex-col items-center gap-4">
                <img id="avatar-preview" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-indigo-500"
                     src="{{ $user->avatar ? asset($user->avatar) : 'https://placehold.co/96x96/a7a7a7/ffffff?text=User' }}"
                     alt="Foto Profil">
                <label class="cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                    <span>Unggah Foto</span>
                    <input type="file" name="avatar" id="avatar-input" class="hidden" onchange="previewImage(event)">
                </label>
                @error('avatar')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input id="name" name="name" type="text" class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out px-4 py-2" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out px-4 py-2" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95">
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
            const file = event.target.files[0];
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
