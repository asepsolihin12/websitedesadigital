<footer class="bg-gray-900 text-gray-300 pt-14 pb-8">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            
            <!-- Logo + Deskripsi -->
            <div class="md:col-span-2 space-y-4">
                    <span class="text-2xl font-bold text-white">SIPMIL</span>

                <p class="text-gray-400 leading-relaxed">
                    Sistem Pengaduan Masyarakat dan Informasi Resmi Desa Langensari.
                    Dikelola untuk kemudahan warga dalam mendapatkan pelayanan dan berita terbaru.
                </p>

                <div class="flex gap-4 items-center">
                    @forelse($mediaSocials as $medsos)
                        <a 
                            href="{{ $medsos->url }}" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-full transition transform hover:scale-110 duration-200"
                            title="{{ $medsos->platform }}"
                        >
                            <!-- Gunakan icon langsung dari database -->
                            <i class="fab fa-{{ $medsos->icon }} text-xl"></i>
                        </a>
                    @empty
                        <span class="text-gray-500 text-sm">Media sosial belum dikonfigurasi</span>
                    @endforelse
                </div>
            </div>

            <!-- Navigasi -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition">Profil Desa</a></li>
                    <li><a href="{{ route('pengaduan.form') }}" class="hover:text-white transition">Pengaduan</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-white transition">Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Kontak</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex gap-2 items-start">
                        <i class="fa-solid fa-location-dot mt-1"></i>
                        Jl. Raya Langensari No. 123  
                        Kota Banjar, Jawa Barat
                    </li>

                    <li class="flex gap-2 items-center">
                        <i class="fa-solid fa-phone"></i>
                        (0281) 4567-890
                    </li>

                    <li class="flex gap-2 items-center">
                        <i class="fa-solid fa-envelope"></i>
                        info@desalangensari.id
                    </li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-12 pt-6 text-center text-gray-500 text-sm">
            © {{ date('Y') }} Desa Langensari. Semua hak dilindungi.
        </div>

    </div>
</footer>