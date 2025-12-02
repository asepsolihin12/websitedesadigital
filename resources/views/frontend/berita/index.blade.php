@extends('frontend.layout.app')

@section('title', 'Berita - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Berita Desa</h1>
        <p class="text-lg">Informasi dan perkembangan terbaru dari Desa Langensari</p>
    </div>
</section>

<!-- Berita Grid Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <!-- Grid Card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($berita as $item)
            <article class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 group">
                <!-- Gambar -->
                @if($item->gambar)
                <div class="overflow-hidden">
                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                </div>
                @else
                <div class="w-full h-48 bg-gradient-to-br from-orange-100 to-yellow-100 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-orange-400 text-4xl"></i>
                </div>
                @endif
                
                <!-- Content -->
                <div class="p-6">
                    <!-- Meta Info -->
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-500">{{ $item->tanggal->format('d M Y') }}</span>
                        <span class="text-sm text-orange-600 bg-orange-100 px-3 py-1 rounded-full">{{ $item->penulis }}</span>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-orange-600 transition duration-300">
                        {{ $item->judul }}
                    </h3>
                    
                    <!-- Preview Konten -->
                    <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3 text-sm">
                        {{ Str::limit(strip_tags($item->isi), 100) }}
                    </p>
                    
                    <!-- Read More -->
                    <a href="{{ route('news.show', $item->id_berita) }}" 
                       class="inline-flex items-center text-orange-600 font-semibold hover:text-orange-700 transition duration-300 text-sm">
                        Baca Selengkapnya
                        <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($berita->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="flex gap-2">
                <!-- Previous Page Link -->
                @if($berita->onFirstPage())
                <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $berita->previousPageUrl() }}" 
                   class="px-4 py-2 text-orange-600 bg-orange-50 rounded-lg hover:bg-orange-100 transition duration-300">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                @endif

                <!-- Page Numbers -->
                @foreach(range(1, $berita->lastPage()) as $i)
                    @if($i == $berita->currentPage())
                    <span class="px-4 py-2 text-white bg-orange-600 rounded-lg">{{ $i }}</span>
                    @else
                    <a href="{{ $berita->url($i) }}" 
                       class="px-4 py-2 text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        {{ $i }}
                    </a>
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if($berita->hasMorePages())
                <a href="{{ $berita->nextPageUrl() }}" 
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
    </div>
</section>
@endsection