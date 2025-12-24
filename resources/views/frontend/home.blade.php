@extends('frontend.layout.app')

@section('title', 'Beranda - SIPMIL')

@section('content')
<!-- Hero Section Simple -->
<section class="hero-section text-white w-full min-h-screen" 
    @if($hero && $hero->gambar)
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('storage/' . $hero->gambar) }}'); background-size: cover; min-height: 100vh; background-position: center; display: flex; align-items: center;"
    @else
        style="background: linear-gradient(to right, #FF6B00, #FF8C00); min-height: 70vh; display: flex; align-items: center;"
    @endif
>
    <div class="container mx-auto px-4 text-center">
        @if($hero)
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                {{ $hero->judul ?? 'SIPMIL' }}
            </h1>
            @if($hero->subjudul)
                <h2 class="text-xl md:text-2xl lg:text-3xl mb-6 text-orange-300">
                    {{ $hero->subjudul }}
                </h2>
            @endif
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
                {{ $hero->deskripsi ?? 'SISTEM PENGADUAN MASYARAKAT DAN INFORMASI LANGENSARI' }}
            </p>
        @else
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                Desa Langensari
            </h1>
            <h2 class="text-xl md:text-2xl lg:text-3xl mb-6 text-orange-300">
                Website Resmi Desa
            </h2>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
                Portal informasi dan pelayanan masyarakat desa yang modern
            </p>
        @endif

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('pengaduan.form') }}" 
               class="bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700 transition">
                Ajukan Pengaduan
            </a>
            <a href="{{ route('surat-online.index') }}" 
               class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-600 transition">
                Surat Online
            </a>
        </div>
    </div>
</section>

<!-- Layanan Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Layanan Desa</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Berbagai layanan digital yang memudahkan warga dalam mengurus administrasi dan menyampaikan aspirasi
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Pengaduan Online -->
            <div class="service-card bg-white rounded-2xl p-8 text-center group cursor-pointer">
                <div class="w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 transition-all duration-300">
                    <i class="fa-solid fa-bullhorn text-3xl text-orange-600 group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Pengaduan Online</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Sampaikan keluhan, kritik, dan saran untuk perbaikan pelayanan desa secara online
                </p>
                <a href="{{ route('pengaduan.form') }}" class="inline-flex items-center text-orange-600 font-semibold group-hover:text-orange-700">
                    Ajukan Pengaduan
                    <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Surat Online -->
            <div class="service-card bg-white rounded-2xl p-8 text-center group cursor-pointer">
                <div class="w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 transition-all duration-300">
                    <i class="fa-solid fa-file-contract text-3xl text-orange-600 group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Surat Online</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Ajukan pembuatan surat administrasi secara online tanpa perlu antri di kantor desa
                </p>
                <a href="{{ route('surat-online.index') }}" class="inline-flex items-center text-orange-600 font-semibold group-hover:text-orange-700">
                    Buat Surat
                    <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Informasi Desa -->
            <div class="service-card bg-white rounded-2xl p-8 text-center group cursor-pointer">
                <div class="w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 transition-all duration-300">
                    <i class="fa-solid fa-info-circle text-3xl text-orange-600 group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Informasi Desa</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Akses informasi terbaru tentang kegiatan, program, dan pengumuman resmi dari desa
                </p>
                <a href="{{ route('informasi') }}" class="inline-flex items-center text-orange-600 font-semibold group-hover:text-orange-700">
                    Lihat Informasi
                    <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
                <p class="text-xl text-gray-600">Informasi dan perkembangan terbaru dari Desa Langensari</p>
            </div>
            <a href="{{ route('news') }}" class="hidden md:flex items-center text-orange-600 font-semibold text-lg hover:text-orange-700">
                Lihat Semua Berita
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($berita as $item)
            <article class="news-card bg-white rounded-2xl shadow-md overflow-hidden">
                @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" 
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-orange-400 text-4xl"></i>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-500">{{ $item->tanggal->format('d M Y') }}</span>
                        <span class="text-sm text-orange-600 bg-orange-100 px-2 py-1 rounded-full">{{ $item->penulis }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $item->judul }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($item->isi), 120) }}</p>
                    <a href="{{ route('news.show', $item->id_berita) }}" 
                       class="inline-flex items-center text-orange-600 font-semibold hover:text-orange-700">
                        Baca Selengkapnya
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Mobile View All Button -->
        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('news') }}" class="inline-flex items-center text-orange-600 font-semibold text-lg hover:text-orange-700">
                Lihat Semua Berita
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Testimoni Section -->
@if($testimoni && $testimoni->count() > 0)
<section class="py-20 bg-gradient-to-r from-orange-500 to-yellow-500 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Apa Kata Warga?</h2>
            <p class="text-xl text-orange-100">Testimoni dari warga tentang pelayanan desa</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimoni as $item)
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-user text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold">{{ $item->nama }}</h4>
                        <div class="flex text-yellow-300">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star{{ $i <= $item->rating ? '' : '-empty' }} text-sm"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-orange-100 italic">"{{ $item->komentar }}"</p>
                <span class="text-sm text-orange-200 mt-3 block">{{ $item->tanggal->format('d M Y') }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@section('scripts')
<script>
    // Animasi counter stats
    function animateCounter(element, target, duration) {
        let start = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start) + '+';
            }
        }, 16);
    }

    // Intersection Observer untuk animasi counter
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('[data-counter]');
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-counter'));
                    animateCounter(counter, target, 2000);
                });
                observer.unobserve(entry.target);
            }
        });
    });

    // Observe hero section untuk animasi counter
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        observer.observe(heroSection);
    }
</script>
@endsection