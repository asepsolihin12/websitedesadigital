@extends('frontend.layout.app')

@section('title', 'Ajukan Surat - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Ajukan Surat Online</h1>
        <p class="text-lg">Permudah urusan administrasi dengan layanan surat online</p>
    </div>
</section>

<!-- Form Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <i class="fa-solid fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 md:p-8">
                <form action="{{ route('surat-online.store') }}" method="POST">
                    @csrf
                    
                    @auth
                    <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                    @endauth

                    <!-- Jenis Surat -->
                    <div class="mb-6">
                        <label for="jenis_surat" class="block text-gray-700 font-semibold mb-2">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis_surat" name="jenis_surat" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300">
                            <option value="">Pilih Jenis Surat</option>
                            <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                            <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                            <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                            <option value="Surat Keterangan Kelahiran">Surat Keterangan Kelahiran</option>
                            <option value="Surat Keterangan Kematian">Surat Keterangan Kematian</option>
                            <option value="Surat Pengantar">Surat Pengantar</option>
                            <option value="Surat Keterangan Lainnya">Surat Keterangan Lainnya</option>
                        </select>
                        @error('jenis_surat')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-6">
                        <label for="keterangan" class="block text-gray-700 font-semibold mb-2">
                            Keterangan Tambahan
                        </label>
                        <textarea id="keterangan" name="keterangan" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300"
                                  placeholder="Tambahkan keterangan atau detail khusus jika diperlukan..."></textarea>
                        @error('keterangan')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Info untuk guest -->
                    @guest
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <i class="fa-solid fa-info-circle text-yellow-600 mt-1 mr-3"></i>
                            <div>
                                <p class="text-yellow-800 text-sm">
                                    Anda belum login. 
                                    <a href="{{ route('login') }}" class="font-semibold underline">Login</a> untuk melacak status pengajuan surat.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endguest

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                        <a href="{{ route('surat-online.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold transition duration-300">
                            <i class="fa-solid fa-arrow-left mr-2"></i>Kembali ke Daftar
                        </a>
                        <button type="submit" 
                                class="bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            Ajukan Surat
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                    <i class="fa-solid fa-circle-info mr-2"></i>
                    Informasi Pengajuan Surat
                </h3>
                <ul class="text-blue-700 text-sm space-y-2">
                    <li class="flex items-start">
                        <i class="fa-solid fa-clock mr-2 mt-1"></i>
                        Proses pengajuan surat membutuhkan waktu 2-3 hari kerja
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-phone mr-2 mt-1"></i>
                        Status pengajuan dapat dicek di halaman Surat Online
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-download mr-2 mt-1"></i>
                        Surat yang sudah selesai dapat diambil di kantor desa
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-file-signature mr-2 mt-1"></i>
                        Pastikan data yang diisi sudah benar dan lengkap
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection