<!-- NAVBAR MODERN DESA LANGENSARI -->
<header class="sticky top-0 z-50 bg-orange-500/90 backdrop-blur-md shadow">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.webp') }}" class="w-10 h-10 rounded-xl shadow-lg object-cover" alt="Logo Desa">
                <span class="text-white font-bold text-xl">Desa Langensari</span>
            </div>

            <!-- Desktop Menu -->
            <!-- Desktop Menu -->
<div class="hidden md:flex items-center gap-8 text-white font-medium">

    <a href="{{ route('home') }}" class="hover:text-gray-200 transition">Beranda</a>

    <!-- Profil Desa Dropdown -->
    <div x-data="{ open: false }" class="relative">
        <button 
            @mouseover="open = true" 
            @mouseleave="open = false"
            class="flex items-center gap-1 hover:text-gray-200"
        >
            Profil Desa 
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </button>

        <div
            x-show="open"
            @mouseover="open = true"
            @mouseleave="open = false"
            x-transition
            class="absolute left-0 mt-2 w-52 bg-white text-gray-700 shadow-xl rounded-lg py-3 border border-gray-100"
        >
            <a href="{{ route('about') }}" class="block px-4 py-2 hover:bg-gray-100">Tentang</a>
            <a href="{{ route('sejarah') }}" class="block px-4 py-2 hover:bg-gray-100">Sejarah</a>
            <a href="{{ route('tenagaKerja') }}" class="block px-4 py-2 hover:bg-gray-100">Tenaga Kerja</a>
            <a href="{{ route('informasi') }}" class="block px-4 py-2 hover:bg-gray-100">Informasi Desa</a>
        </div>
    </div>

    <!-- MENU PUBLIC - SELALU TAMPIL -->
    <a href="{{ route('news') }}" class="hover:text-gray-200 transition">Berita</a>
    <a href="{{ route('gallery') }}" class="hover:text-gray-200 transition">Galeri</a>
    <a href="{{ route('contact') }}" class="hover:text-gray-200 transition">Kontak</a>

    <!-- Auth Section -->
    @auth
        <!-- Layanan Dropdown (HANYA untuk user login) -->
        <div x-data="{ open: false }" class="relative">
            <button 
                @mouseover="open = true" 
                @mouseleave="open = false"
                class="flex items-center gap-1 hover:text-gray-200"
            >
                Layanan 
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>

            <div
                x-show="open"
                @mouseover="open = true"
                @mouseleave="open = false"
                x-transition
                class="absolute left-0 mt-2 w-52 bg-white text-gray-700 shadow-xl rounded-lg py-3 border border-gray-100"
            >
                <a href="{{ route('pengaduan.form') }}" class="block px-4 py-2 hover:bg-gray-100">Pengaduan</a>
                <a href="{{ route('surat-online.index') }}" class="block px-4 py-2 hover:bg-gray-100">Surat Online</a>
            </div>
        </div>

        <!-- User Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button 
                @mouseover="open = true" 
                @mouseleave="open = false"
                class="flex items-center gap-2 hover:text-gray-200"
            >
                <i class="fa-solid fa-circle-user text-xl"></i>
                {{ Auth::user()->name }}
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>

            <div
                x-show="open"
                @mouseover="open = true"
                @mouseleave="open = false"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white text-gray-700 shadow-xl rounded-lg py-3 border border-gray-100"
            >
                <a href="{{ route('pengaduan.riwayat') }}" class="block px-4 py-2 hover:bg-gray-100">
                    <i class="fa-solid fa-history mr-2"></i>Riwayat Pengaduan
                </a>

                <!-- SIMPLE LOGOUT LINK -->
                <a href="/simple-logout" 
                   class="block px-4 py-2 hover:bg-gray-100 text-red-600"
                   onclick="return confirm('Yakin mau logout?')">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
                </a>
            </div>
        </div>
    @else
        <!-- Tampilkan login/register jika belum login -->
        <a href="{{ route('login') }}" class="hover:text-gray-200">
            <i class="fa-solid fa-right-to-bracket mr-1"></i> Login
        </a>
        <a href="{{ route('register') }}" class="bg-white text-orange-600 px-4 py-1 rounded-lg hover:bg-gray-100 transition">
            Daftar
        </a>
    @endauth

</div>

            <!-- Mobile Button -->
            <button class="md:hidden text-white text-2xl" id="mobile-menu-button">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
       <!-- Mobile Menu -->
<div class="md:hidden hidden mt-4 space-y-3 text-white font-medium" id="mobile-menu">

    <a href="{{ route('home') }}" class="block">Beranda</a>

    <details class="bg-orange-600/70 backdrop-blur px-3 py-2 rounded">
        <summary class="cursor-pointer">Profil Desa</summary>
        <div class="pl-4 mt-2 space-y-1 text-sm">
            <a href="{{ route('about') }}">Tentang</a>
            <a href="{{ route('sejarah') }}">Sejarah</a>
            <a href="{{ route('tenagaKerja') }}">Tenaga Kerja</a>
            <a href="{{ route('informasi') }}">Informasi Desa</a>
        </div>
    </details>

    <!-- MENU PUBLIC - SELALU TAMPIL -->
    <a href="{{ route('news') }}" class="block">Berita</a>
    <a href="{{ route('gallery') }}" class="block">Galeri</a>
    <a href="{{ route('contact') }}" class="block">Kontak</a>

    @auth
        <details class="bg-orange-600/70 backdrop-blur px-3 py-2 rounded">
            <summary class="cursor-pointer">Layanan</summary>
            <div class="pl-4 mt-2 space-y-1 text-sm">
                <a href="{{ route('pengaduan.form') }}">Pengaduan</a>
                <a href="{{ route('surat-online.index') }}">Surat Online</a>
            </div>
        </details>

        <a href="{{ route('pengaduan.riwayat') }}" class="block">
            <i class="fa-solid fa-history mr-2"></i>Riwayat Pengaduan
        </a>
        
        <!-- SIMPLE LOGOUT LINK MOBILE -->
        <a href="/simple-logout" 
           class="block text-red-600"
           onclick="return confirm('Yakin mau logout?')">
            <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
        </a>
    @else
        <a href="{{ route('login') }}" class="block">
            <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
        </a>
        <a href="{{ route('register') }}" class="block">
            <i class="fa-solid fa-user-plus mr-2"></i>Daftar
        </a>
    @endauth

</div>
    </nav>
</header>

<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Mobile Menu Toggle -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>