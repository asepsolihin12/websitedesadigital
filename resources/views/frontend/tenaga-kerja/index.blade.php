@extends('frontend.layout.app')

@section('title', 'Struktur Pemerintahan - Desa Langensari')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">

        @if($list->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($list as $tenaga)
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300">

                <!-- Header -->
                <div class="h-2 bg-gradient-to-r from-orange-500 to-yellow-500"></div>

                <!-- Content -->
                <div class="p-6 text-center">

                    <!-- Gambar -->
                    @if($tenaga->gambar)
                        <div class="overflow-hidden mb-4">
                            <img
                                src="{{ asset('storage/' . $tenaga->gambar) }}"
                                alt="{{ $tenaga->nama }}"
                                class="w-full h-48 object-cover transition duration-500">
                        </div>
                    @endif

                    <!-- Nama -->
                    <h3 class="text-lg font-bold text-gray-800 mb-2">
                        {{ $tenaga->nama }}
                    </h3>

                    <!-- Jabatan -->
                    <div class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium mb-3 inline-block">
                        {{ $tenaga->jabatan }}
                    </div>

                    <!-- Bio -->
                    @if($tenaga->bio)
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ $tenaga->bio }}
                        </p>
                    @endif

                    <!-- Kontak -->
                    @if($tenaga->kontak)
                        <div class="border-t border-gray-100 pt-3">
                            <div class="flex items-center justify-center text-gray-500 text-sm">
                                <i class="fa-solid fa-phone mr-2"></i>
                                <span>{{ $tenaga->kontak }}</span>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            @endforeach

        </div>
        @else

        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="bg-gray-50 rounded-xl p-8 max-w-md mx-auto">
                <i class="fa-solid fa-users text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">
                    Data Belum Tersedia
                </h3>
                <p class="text-gray-500">
                    Informasi tenaga kerja sedang disiapkan
                </p>
            </div>
        </div>

        @endif

    </div>
</section>
@endsection
