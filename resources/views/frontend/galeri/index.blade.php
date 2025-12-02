@extends('frontend.layout.app')

@section('title', 'Galeri - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Galeri Desa</h1>
        <p class="text-lg">Dokumentasi kegiatan dan momen penting Desa Langensari</p>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        @if($items->count() > 0)
        <!-- Masonry Grid -->
        <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-4 space-y-4">
            @foreach($items as $item)
            <div class="break-inside-avoid group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 mb-4">
                @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" 
                     alt="{{ $item->judul }}" 
                     class="w-full rounded-xl group-hover:scale-105 transition duration-700">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-orange-100 to-yellow-100 flex items-center justify-center rounded-xl">
                    <i class="fa-solid fa-image text-orange-400 text-4xl"></i>
                </div>
                @endif
                
                <!-- Overlay Info -->
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-70 transition duration-500 flex flex-col justify-end p-4">
                    <div class="transform translate-y-8 group-hover:translate-y-0 transition duration-500">
                        <h3 class="text-white font-bold text-lg mb-1">{{ $item->judul }}</h3>
                        <p class="text-orange-200 text-sm mb-2 line-clamp-2">{{ $item->deskripsi }}</p>
                        <span class="text-orange-300 text-xs">{{ $item->tanggal->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($items->hasPages())
        <div class="mt-12 flex justify-center">
            <div class="flex gap-2">
                <!-- Previous Page Link -->
                @if($items->onFirstPage())
                <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $items->previousPageUrl() }}" 
                   class="px-4 py-2 text-orange-600 bg-orange-50 rounded-lg hover:bg-orange-100 transition duration-300">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                @endif

                <!-- Page Numbers -->
                @foreach(range(1, $items->lastPage()) as $i)
                    @if($i == $items->currentPage())
                    <span class="px-4 py-2 text-white bg-orange-600 rounded-lg">{{ $i }}</span>
                    @else
                    <a href="{{ $items->url($i) }}" 
                       class="px-4 py-2 text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        {{ $i }}
                    </a>
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if($items->hasMorePages())
                <a href="{{ $items->nextPageUrl() }}" 
                   class="px-4 py-2 text-orange-600 bg-orange-50 rounded-lg hover:bg-orange-100 transition duration-300">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                @else
                <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                @endif
            </div>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-2xl p-12 max-w-md mx-auto border border-orange-100">
                <i class="fa-solid fa-images text-orange-400 text-6xl mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Galeri Masih Kosong</h3>
                <p class="text-gray-600 mb-6">
                    Dokumentasi kegiatan desa akan segera tersedia di sini.
                </p>
                <div class="w-24 h-1 bg-orange-500 rounded-full mx-auto"></div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection