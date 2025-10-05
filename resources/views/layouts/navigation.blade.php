<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Navigation Bar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Hamburger animation */
        .hamburger-line {
            display: block;
            width: 20px;
            height: 2px;
            background-color: #1e40af;
            border-radius: 9999px;
            transition: all 0.3s ease-in-out;
            margin: 3px 0;
        }

        .hamburger-active .hamburger-line:nth-child(1) {
            transform: rotate(-45deg) translate(-4px, 5px);
        }

        .hamburger-active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger-active .hamburger-line:nth-child(3) {
            transform: rotate(45deg) translate(-4px, -5px);
        }

        /* Dropdown animation */
        .dropdown {
            display: none;
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.2s ease-out;
        }

        .dropdown.active {
            display: block;
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Mobile specific styles */
        @media (max-width: 1023px) {
            /* Hide desktop navigation links on mobile/tablet */
            .desktop-nav-links {
                display: none !important;
            }

            /* Adjust navbar height for mobile */
            nav {
                height: auto;
                min-height: 70px;
            }

            /* Make logo smaller on mobile */
            .logo-img {
                width: 120px !important;
                height: auto;
            }

            /* Adjust profile image size */
            .profile-img {
                width: 40px !important;
                height: 40px !important;
            }

            /* Hide user name on very small screens */
            .user-name {
                display: none;
            }

            /* Hide desktop menu button on mobile */
            .desktop-menu-btn {
                display: none !important;
            }

            /* Show mobile hamburger */
            .mobile-menu-btn {
                display: flex !important;
            }

            /* Adjust dropdown position for mobile */
            .dropdown {
                right: 0;
                top: 60px;
                width: 90vw;
                max-width: 320px;
            }

            /* Mobile navigation section in dropdown */
            .mobile-nav-section {
                display: block !important;
            }
        }

        /* Tablet specific adjustments */
        @media (min-width: 640px) and (max-width: 1023px) {
            .logo-img {
                width: 140px !important;
            }

            .profile-img {
                width: 48px !important;
                height: 48px !important;
            }

            .user-name {
                display: flex !important;
            }
        }

        /* Desktop styles */
        @media (min-width: 1024px) {
            .desktop-nav-links {
                display: flex !important;
            }

            .desktop-menu-btn {
                display: flex !important;
            }

            .mobile-menu-btn {
                display: none !important;
            }

            .mobile-nav-section {
                display: none !important;
            }
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="w-full bg-gradient-to-r from-sky-500 via-green-500 to-green-600 shadow-2xl shadow-green-600/50 z-50">
        <div class="flex justify-between items-center h-20 px-4 sm:px-6 lg:px-12">
            <!-- Left Section: Logo and Navigation -->
            <div class="flex items-center gap-4 lg:gap-10">
                <h1 class="flex items-center">
                    <img src="{{ asset('gambar/logoo.png') }}" alt="Logo BPJS" class="logo-img w-40 h-auto drop-shadow-lg">
                </h1>

                <!-- Desktop Navigation Links (Hidden on mobile/tablet) -->
                <div class="desktop-nav-links gap-3">
                    {{-- Navigasi untuk Admin --}}
                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('bpjs.ketenagakerjaan') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">BPJS Ketenagakerjaan</span>
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Beranda</span>
                    </a>
                    <a href="{{ route('penugasan.index') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Penugasan</span>
                    </a>

                    {{-- Navigasi untuk CS --}}
                    @elseif(Auth::check() && Auth::user()->role === 'cs')
                    <a href="{{ route('bpjs.ketenagakerjaancs') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">BPJS Ketenagakerjaan</span>
                    </a>
                    <a href="{{ route('dashboardcs') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Beranda</span>
                    </a>

                    {{-- Navigasi untuk User Biasa --}}
                    @else
                    <a href="{{ route('bpjs.ketenagakerjaanuser') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">BPJS Ketenagakerjaan</span>
                    </a>
                    <a href="{{ route('dashboarduser') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Beranda</span>
                    </a>
                    <a href="{{ route('penugasanuser') }}"
                        class="group shadow-md hover:shadow-xl text-white font-semibold text-base lg:text-lg px-3 lg:px-4 py-2 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 hover:bg-white hover:shadow-xl no-underline">
                        <span class="group-hover:text-green-600 transition-colors duration-150">Penugasan</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Right Section: User Profile -->
            @if(Auth::check())
            <div class="relative flex items-center gap-2 sm:gap-3 lg:gap-4">
                <!-- Profile Photo -->
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff&size=56' }}"
                    alt="Foto Profil" class="profile-img w-12 h-12 lg:w-14 lg:h-14 rounded-full border-3 lg:border-4 border-white shadow-xl">
                
                <!-- User Name (Hidden on very small screens) -->
                <div class="user-name hidden sm:flex flex-col items-start">
                    <span class="text-white font-semibold text-sm lg:text-base">{{ Auth::user()->name }}</span>
                </div>

                <!-- Desktop Menu Button -->
                <button onclick="toggleDropdown()" id="desktopMenuBtn"
                    class="desktop-menu-btn items-center justify-center gap-2 bg-white text-green-800 text-sm font-semibold px-4 py-2 rounded-full shadow-md hover:bg-gray-100 transition-all duration-200"
                    style="min-width: 120px;">
                    <span>Menu</span>
                    <svg id="menuArrow" class="w-4 h-4 text-green-800" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Mobile Hamburger Button -->
                <button onclick="toggleDropdown()" id="mobileMenuBtn"
                    class="mobile-menu-btn items-center justify-center w-10 h-10 bg-white text-green-800 rounded-full shadow-lg shadow-green-500/50 hover:bg-gray-100 transition-all duration-200">
                    <div id="hamburgerIcon" class="hamburger">
                        <div class="hamburger-line"></div>
                        <div class="hamburger-line"></div>
                        <div class="hamburger-line"></div>
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="dropdown absolute right-0 top-16 lg:top-20 w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 p-2">
                    <!-- Mobile Navigation Links (only visible on mobile/tablet) -->
                    <div class="mobile-nav-section mb-2 border-b border-gray-200 pb-2">
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('bpjs.ketenagakerjaan') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="text-sm">BPJS Ketenagakerjaan</span>
                            </div>
                        </a>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="text-sm">Beranda</span>
                            </div>
                        </a>
                        <a href="{{ route('penugasan.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="text-sm">Penugasan</span>
                            </div>
                        </a>
                        @elseif(Auth::user()->role === 'cs')
                        <a href="{{ route('bpjs.ketenagakerjaancs') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="text-sm">BPJS Ketenagakerjaan</span>
                            </div>
                        </a>
                        <a href="{{ route('dashboardcs') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="text-sm">Beranda</span>
                            </div>
                        </a>
                        @else
                        <a href="{{ route('bpjs.ketenagakerjaanuser') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="text-sm">BPJS Ketenagakerjaan</span>
                            </div>
                        </a>
                        <a href="{{ route('dashboarduser') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="text-sm">Beranda</span>
                            </div>
                        </a>
                        <a href="{{ route('penugasanuser') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="text-sm">Penugasan</span>
                            </div>
                        </a>
                        @endif
                    </div>
                    
                    <!-- Common Menu Items -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 no-underline">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profil</span>
                    </a>
                    <a href="{{ route('tentang') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-150 no-underline">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Tentang</span>
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <!-- Guest User -->
            <div class="flex items-center gap-2 sm:gap-4">
                <img src="https://ui-avatars.com/api/?name=Guest&background=gray&color=fff&size=56" alt="Guest" class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full border-3 lg:border-4 border-white shadow-xl">
                <span class="text-white font-medium text-sm sm:text-base hidden sm:block">Guest</span>
                <a href="{{ route('login') }}" class="bg-white text-green-800 font-semibold px-3 sm:px-4 py-2 text-sm rounded-full hover:bg-gray-100 transition-all duration-200 shadow-lg">Login</a>
            </div>
            @endif
        </div>
    </nav>

    <script>
        let isDropdownOpen = false;

        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            const arrow = document.getElementById('menuArrow');
            const hamburger = document.getElementById('hamburgerIcon');
            
            isDropdownOpen = !isDropdownOpen;
            
            if (isDropdownOpen) {
                dropdown.classList.add('active');
                if (arrow) arrow.style.transform = 'rotate(180deg)';
                if (hamburger) hamburger.classList.add('hamburger-active');
            } else {
                dropdown.classList.remove('active');
                if (arrow) arrow.style.transform = 'rotate(0deg)';
                if (hamburger) hamburger.classList.remove('hamburger-active');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const desktopBtn = document.getElementById('desktopMenuBtn');
            const mobileBtn = document.getElementById('mobileMenuBtn');
            
            const isClickOnButton = event.target.closest('#desktopMenuBtn') || event.target.closest('#mobileMenuBtn');
            const isClickInDropdown = dropdown && dropdown.contains(event.target);
            
            if (!isClickOnButton && !isClickInDropdown && isDropdownOpen) {
                toggleDropdown();
            }
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && isDropdownOpen) {
                toggleDropdown();
            }
        });
    </script>
</body>

</html>