<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Gaya Dasar & Palet Warna */
        :root {
            --primary-green: #009944; /* Hijau kuat dari BPJS */
            --secondary-green: #008080; /* Teal dari BPJS */
            --light-green: #e6ffee; /* Latar belakang hijau sangat muda */
            --dark-gray: #374151;
            --medium-gray: #6b7280;
            --border-light: #e5e7eb;
            --success-text: #065f46;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #e0f2f1, #c8e6c9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: var(--dark-gray);
        }

        .profile-card {
            background: linear-gradient(to bottom, #bfd8b8ff, #f0fdf4);
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .btn-bpjs {
            background: linear-gradient(to right, var(--secondary-green), var(--primary-green));
            color: white;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 128, 128, 0.2);
        }
        .btn-bpjs:hover {
            background: linear-gradient(to right, #005f5f, #007739);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 128, 128, 0.3);
        }
        .btn-bpjs:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 128, 128, 0.1);
        }
        
        /* Input Focus Style */
        input:focus {
            border-color: var(--primary-green) !important;
            box-shadow: 0 0 0 3px rgba(0, 153, 68, 0.2) !important;
            outline: none;
        }

        /* Gaya Alert di Tengah Layar */
        .centered-alert-container {
            position: fixed;
            top: 2rem; /* Jarak dari atas */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: fit-content; /* Sesuai konten */
            max-width: 90%; /* Batasi lebar agar tidak terlalu besar di mobile */
        }

        .alert-success-centered {
            background-color: var(--light-green);
            color: var(--success-text);
            border-left: 5px solid var(--primary-green);
            border-radius: 0.75rem; /* Sudut lebih membulat */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); /* Bayangan lebih jelas */
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: fadeInDownScale 0.6s ease-out forwards;
            opacity: 0; /* Mulai tersembunyi */
            transform-origin: top center;
        }
        
        .alert-success-centered .alert-icon {
            font-size: 1.8rem; /* Ikon sedikit lebih besar */
            color: var(--primary-green);
        }
        .alert-success-centered .alert-title {
            font-weight: 700;
            font-size: 1.1rem;
        }
        .alert-success-centered .alert-message {
            font-size: 0.95rem;
        }

        @keyframes fadeInDownScale {
            0% {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Animasi fade-out untuk alert */
        .alert-fade-out {
            animation: fadeOutUp 0.6s ease-in forwards;
        }

        @keyframes fadeOutUp {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
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

            <div id="alert-placeholder"></div>

            <div class="flex flex-col items-center gap-4">
                <img id="avatar-preview" class="w-32 h-32 rounded-full object-cover shadow-lg border-2 border-primary-green"
                     src="{{ $user->avatar ? asset($user->avatar) : 'https://placehold.co/128x128/a7a7a7/ffffff?text=User' }}"
                     alt="Foto Profil">
                <label class="cursor-pointer btn-bpjs font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                    <span>Unggah Foto</span>
                    <input type="file" name="avatar" id="avatar-input" class="hidden" onchange="previewImage(event)">
                </label>
                @error('avatar')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input id="name" name="name" type="text" class="block w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" class="block w-full border-gray-300 rounded-lg shadow-sm px-4 py-2" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ Auth::user()->role === 'admin' ? route('bpjs.ketenagakerjaan') : route('bpjs.ketenagakerjaanuser') }}"
                   class="inline-flex items-center btn-bpjs font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

                <button type="submit" class="btn-bpjs font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    
    <script>
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

        // Script untuk alert di tengah layar
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'profile-updated')
                const alertPlaceholder = document.getElementById('alert-placeholder');
                const alertHtml = `
                    <div class="centered-alert-container">
                        <div class="alert-success-centered" role="alert">
                            <span class="alert-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div>
                                <p class="alert-title">Sukses!</p>
                                <p class="alert-message">Profil Anda berhasil diperbarui.</p>
                            </div>
                        </div>
                    </div>
                `;
                
                alertPlaceholder.innerHTML = alertHtml;
                const currentAlert = alertPlaceholder.querySelector('.alert-success-centered');

                // Otomatis sembunyikan alert setelah 3 detik
                setTimeout(() => {
                    if (currentAlert) {
                        currentAlert.classList.add('alert-fade-out');
                        currentAlert.addEventListener('animationend', () => {
                            currentAlert.remove();
                        });
                    }
                }, 3000); // Alert akan hilang setelah 3 detik (3000 ms)
            @endif
        });
    </script>
</body>
</html>