@extends('frontend.layout.app')

@section('title', 'Sejarah Desa - Desa Langensari')

@section('content')

<!-- Timeline Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            @if($items->count() > 0)
            <!-- Timeline -->
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-orange-200 h-full hidden lg:block"></div>
                
                @foreach($items as $index => $item)
                <div class="relative mb-12 flex flex-col lg:flex-row {{ $index % 2 == 0 ? '' : 'lg:flex-row-reverse' }} items-center">
                    <!-- Timeline Content -->
                    <div class="lg:w-1/2 {{ $index % 2 == 0 ? 'lg:pr-12 lg:text-right' : 'lg:pl-12' }} mb-6 lg:mb-0">
                        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300 border border-gray-100">
                            <!-- Year Badge -->
                            <div class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-full text-sm font-semibold mb-4">
                                <i class="fa-solid fa-calendar-days mr-2"></i>
                                {{ $item->tahun }}
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $item->judul }}</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">{{ $item->isi }}</p>
                            
                            @if($item->gambar)
                            <div class="mt-4 {{ $index % 2 == 0 ? 'lg:text-right' : '' }}">
                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                     alt="{{ $item->judul }}" 
                                     class="inline-block rounded-lg max-w-full h-48 object-cover shadow-md">
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Timeline Dot -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-orange-500 rounded-full border-4 border-white shadow-lg hidden lg:block z-10"></div>
                    
                    <!-- Year Marker -->
                    <div class="lg:w-1/2 {{ $index % 2 == 0 ? 'lg:pl-12' : 'lg:pr-12' }} lg:text-center">
                        <div class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-3 px-6 rounded-lg shadow-lg">
                            <div class="text-3xl font-bold">{{ $item->tahun }}</div>
                            <div class="text-orange-100 text-sm">Tahun Sejarah</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="bg-gradient-to-br from-orange-100 to-yellow-100 rounded-2xl p-12 max-w-2xl mx-auto">
                    <i class="fa-solid fa-book-open text-orange-400 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Sejarah Desa Sedang Ditulis</h3>
                    <p class="text-gray-600 text-lg mb-6">
                        Cerita perjalanan dan perkembangan Desa Langensari akan segera tersedia di sini.
                    </p>
                    <div class="w-24 h-1 bg-orange-500 rounded-full mx-auto"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-white rounded-2xl p-8 shadow-md">
                <div class="text-4xl font-bold text-orange-600 mb-2">{{ $items->count() }}</div>
                <div class="text-gray-600 font-semibold">Tahun Sejarah</div>
                <div class="text-sm text-gray-500 mt-2">Dokumentasi perjalanan</div>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-md">
                <div class="text-4xl font-bold text-orange-600 mb-2">
                    {{ $items->count() > 0 ? $items->first()->tahun : '-' }}
                </div>
                <div class="text-gray-600 font-semibold">Tahun Terawal</div>
                <div class="text-sm text-gray-500 mt-2">Awal pencatatan</div>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-md">
                <div class="text-4xl font-bold text-orange-600 mb-2">
                    {{ $items->count() > 0 ? $items->last()->tahun : '-' }}
                </div>
                <div class="text-gray-600 font-semibold">Tahun Terbaru</div>
                <div class="text-sm text-gray-500 mt-2">Update terakhir</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-orange-500 to-yellow-500 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Miliki Cerita Sejarah?</h2>
        <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
            Jika Anda memiliki informasi atau dokumentasi sejarah desa yang ingin dibagikan, 
            silakan hubungi kami untuk melengkapi cerita perjalanan Desa Langensari.
        </p>
        <a href="{{ route('contact') }}" 
           class="bg-white text-orange-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition duration-300 inline-flex items-center gap-2">
            <i class="fa-solid fa-envelope"></i>
            Hubungi Kami
        </a>
    </div>
</section>
@endsection

@section('styles')
<style>
    @media (min-width: 1024px) {
        .lg\:w-1\/2 {
            width: 50%;
        }
    }
</style>
@endsection