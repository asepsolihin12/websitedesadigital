@extends('frontend.layout.app')

@section('title', 'Hasil Status Pengaduan - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Hasil Status Pengaduan</h1>
        <p class="text-lg">Informasi status pengaduan Anda</p>
    </div>
</section>

<!-- Hasil Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            @if($item)
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 md:p-8">
                <!-- Status Badge -->
                <div class="text-center mb-6">
                    <span class="px-4 py-2 rounded-full text-lg font-semibold 
                        @if($item->status == 'Menunggu') bg-yellow-100 text-yellow-800
                        @elseif($item->status == 'Diproses') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800 @endif">
                        Status: {{ $item->status }}
                    </span>
                </div>

                <!-- Detail Pengaduan -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->judul }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $item->isi }}</p>
                    </div>

                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Tanggal Pengaduan: {{ $item->tanggal->format('d M Y') }}</span>
                        <span>ID: #{{ $item->id_pengaduan }}</span>
                    </div>
                </div>

                <!-- Tanggapan -->
                @if($item->tanggapan->count() > 0)
                <div class="border-t border-gray-100 pt-6 mt-6">
                    <h4 class="font-semibold text-gray-800 mb-4">Tanggapan:</h4>
                    <div class="space-y-4">
                        @foreach($item->tanggapan as $tanggapan)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-medium text-gray-700">{{ $tanggapan->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $tanggapan->tanggal->format('d M Y') }}</span>
                            </div>
                            <p class="text-gray-600">{{ $tanggapan->isi_tanggapan }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @else
            <!-- Not Found -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 text-center">
                <i class="fa-solid fa-search text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Pengaduan Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-4">Pastikan judul pengaduan yang dimasukkan benar</p>
                <a href="{{ route('pengaduan.cekStatus') }}" 
                   class="bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 inline-block">
                    Coba Lagi
                </a>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('pengaduan.cekStatus') }}" 
                   class="text-orange-600 hover:text-orange-700 font-semibold transition duration-300 text-center">
                    Cek Status Lainnya
                </a>
                <a href="{{ route('pengaduan.form') }}" 
                   class="text-orange-600 hover:text-orange-700 font-semibold transition duration-300 text-center">
                    Ajukan Pengaduan Baru
                </a>
            </div>
        </div>
    </div>
</section>
@endsection