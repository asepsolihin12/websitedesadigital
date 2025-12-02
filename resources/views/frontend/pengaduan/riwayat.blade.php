@extends('frontend.layout.app')

@section('title', 'Riwayat Pengaduan - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Riwayat Pengaduan</h1>
        <p class="text-lg">Lacak status pengaduan yang telah Anda ajukan</p>
    </div>
</section>

<!-- Riwayat Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($list->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach($list as $pengaduan)
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition duration-300">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 sm:mb-0">{{ $pengaduan->judul }}</h3>
                    <div class="flex items-center gap-3">
                        <span class="text-gray-500 text-sm">
                            {{ $pengaduan->tanggal->format('d M Y') }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                            @if($pengaduan->status == 'Menunggu') bg-yellow-100 text-yellow-800
                            @elseif($pengaduan->status == 'Diproses') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ $pengaduan->status }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3">
                    {{ $pengaduan->isi }}
                </p>

                <!-- Tanggapan -->
                @if($pengaduan->tanggapan->count() > 0)
                <div class="border-t border-gray-100 pt-4 mt-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Tanggapan:</h4>
                    @foreach($pengaduan->tanggapan as $tanggapan)
                    <div class="bg-gray-50 rounded-lg p-4 mb-2">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium text-gray-700">{{ $tanggapan->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $tanggapan->tanggal->format('d M Y') }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">{{ $tanggapan->isi_tanggapan }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="border-t border-gray-100 pt-4 mt-4">
                    <p class="text-gray-500 text-sm italic">Belum ada tanggapan</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 max-w-md mx-auto">
                <i class="fa-solid fa-inbox text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Pengaduan</h3>
                <p class="text-gray-500 mb-4">Anda belum mengajukan pengaduan</p>
                <a href="{{ route('pengaduan.form') }}" 
                   class="bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 inline-block">
                    Ajukan Pengaduan
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection