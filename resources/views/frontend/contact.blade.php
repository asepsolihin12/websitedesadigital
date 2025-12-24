@extends('frontend.layout.app')

@section('title', 'Kontak - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-lg">Kami siap mendengar aspirasi dan pertanyaan Anda</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fa-solid fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    
                    <!-- Nama -->
                    <div class="mb-6">
                        <label for="nama" class="block text-gray-700 font-semibold mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('nama')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300"
                               placeholder="nama@email.com">
                        @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Pesan -->
                    <div class="mb-6">
                        <label for="pesan" class="block text-gray-700 font-semibold mb-2">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="pesan" name="pesan" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300"
                                  placeholder="Tulis pesan Anda di sini..."></textarea>
                        @error('pesan')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-orange-600 text-white py-3 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <!-- Info Kontak -->
                <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-2xl p-8 border border-orange-100">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <!-- Alamat -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Alamat Kantor Desa</h4>
                                <p class="text-gray-600">
                                    Jl. Raya Langensari No. 123<br>
                                    Kec. Langensari, Kota Banjar<br>
                                    Jawa Barat 46343
                                </p>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-phone text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Telepon</h4>
                                <p class="text-gray-600">(0281) 4567-890</p>
                                <p class="text-gray-600 text-sm mt-1">Senin - Jumat, 08:00 - 16:00 WIB</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-envelope text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                                <p class="text-gray-600">info@desalangensari.id</p>
                                <p class="text-gray-600">admin@desalangensari.id</p>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Jam Operasional</h4>
                                <p class="text-gray-600">
                                    Senin - Kamis: 08:00 - 16:00 WIB<br>
                                    Jumat: 08:00 - 11:00 WIB<br>
                                    Sabtu - Minggu: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection