@extends('frontend.layout.app')

@section('title', $item->judul . ' - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Berita Desa</h1>
        <p class="text-lg">Informasi dan perkembangan terbaru dari Desa Langensari</p>
    </div>
</section>

<!-- Detail Berita -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-orange-600 transition duration-300">Beranda</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-chevron-right mx-2 text-gray-400"></i>
                        <a href="{{ route('news') }}" class="hover:text-orange-600 transition duration-300">Berita</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-chevron-right mx-2 text-gray-400"></i>
                        <span class="text-gray-400">Detail</span>
                    </li>
                </ol>
            </nav>

            <!-- Article -->
            <article class="bg-white rounded-xl">
                <!-- Header -->
                <header class="mb-8">
                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fa-solid fa-calendar mr-2"></i>
                            {{ $item->tanggal->format('d F Y') }}
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-user-pen mr-2"></i>
                            Oleh: {{ $item->penulis }}
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-clock mr-2"></i>
                            {{ $item->tanggal->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Judul -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                        {{ $item->judul }}
                    </h1>
                </header>

                <!-- Featured Image -->
                @if($item->gambar)
                <div class="mb-8 rounded-xl overflow-hidden">
                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-64 md:h-96 object-cover">
                </div>
                @endif

                <!-- Content -->
                <div class="prose prose-lg max-w-none prose-orange prose-headings:text-gray-800 prose-p:text-gray-600 prose-li:text-gray-600">
                    {!! $item->isi !!}
                </div>

                <!-- Share Buttons -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Bagikan Berita</h3>
                    <div class="flex gap-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center gap-2">
                            <i class="fa-brands fa-facebook-f"></i>
                            Facebook
                        </button>
                        <button class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition duration-300 flex items-center gap-2">
                            <i class="fa-brands fa-twitter"></i>
                            Twitter
                        </button>
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp"></i>
                            WhatsApp
                        </button>
                    </div>
                </div>
            </article>

            <!-- Navigation -->
            <div class="mt-12 flex flex-col sm:flex-row justify-between gap-4">
                <a href="{{ route('news') }}" 
                   class="text-orange-600 hover:text-orange-700 font-semibold transition duration-300 flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Daftar Berita
                </a>
                <a href="{{ route('home') }}" 
                   class="text-gray-600 hover:text-gray-800 font-semibold transition duration-300 flex items-center gap-2">
                    <i class="fa-solid fa-home"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection