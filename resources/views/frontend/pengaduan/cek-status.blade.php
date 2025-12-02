@extends('frontend.layout.app')

@section('title', 'Cek Status Pengaduan - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Cek Status Pengaduan</h1>
        <p class="text-lg">Lacak status pengaduan dengan judul pengaduan</p>
    </div>
</section>

<!-- Cek Status Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 md:p-8">
                <form action="{{ route('pengaduan.getStatus') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="judul" class="block text-gray-700 font-semibold mb-2">
                            Judul Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300"
                               placeholder="Masukkan judul pengaduan">
                    </div>

                    <button type="submit" 
                            class="w-full bg-orange-600 text-white py-3 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-search"></i>
                        Cek Status
                    </button>
                </form>
            </div>

            <!-- Info -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Masukkan judul pengaduan yang sama ketika mengajukan pengaduan
                </p>
            </div>
        </div>
    </div>
</section>
@endsection