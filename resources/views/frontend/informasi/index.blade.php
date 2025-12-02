@extends('frontend.layout.app')

@section('title', 'Informasi Desa - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Informasi Desa</h1>
        <p class="text-lg">Berita dan pengumuman terbaru dari Desa Langensari</p>
    </div>
</section>

<!-- Informasi Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        @if($list->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="space-y-6">
                    @foreach($list as $info)
                    <article class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="p-6">
                            <!-- Header -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                                <div class="flex items-center gap-3 mb-3 sm:mb-0">
                                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $info->kategori }}
                                    </span>
                                    <span class="text-gray-500 text-sm">
                                        {{ $info->tanggal->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $info->judul }}</h3>
                            
                            <!-- Content -->
                            <div class="text-gray-600 leading-relaxed prose prose-orange max-w-none">
                                {!! Str::limit(strip_tags($info->isi), 200) !!}
                            </div>
                            
                            <!-- Read More -->
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <button class="text-orange-600 font-semibold text-sm hover:text-orange-700 transition duration-300">
                                    Baca Selengkapnya
                                </button>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Kategori -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Kategori</h3>
                    <div class="space-y-2">
                        @php
                            $kategories = $list->unique('kategori');
                        @endphp
                        @foreach($kategories as $kategori)
                        <a href="#" class="block text-gray-600 hover:text-orange-600 transition duration-300">
                            {{ $kategori->kategori }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Informasi Terbaru -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Terbaru</h3>
                    <div class="space-y-4">
                        @foreach($list->take(3) as $recent)
                        <a href="#" class="block group">
                            <h4 class="font-medium text-gray-800 group-hover:text-orange-600 transition duration-300 text-sm">
                                {{ Str::limit($recent->judul, 50) }}
                            </h4>
                            <span class="text-gray-500 text-xs">{{ $recent->tanggal->format('d M') }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="bg-gray-50 rounded-xl p-8 max-w-md mx-auto">
                <i class="fa-solid fa-newspaper text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Informasi</h3>
                <p class="text-gray-500">Informasi desa akan segera tersedia</p>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection