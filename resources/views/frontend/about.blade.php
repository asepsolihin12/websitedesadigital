@extends('frontend.layout.app')

@section('title', 'Tentang Desa - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang Desa Langensari</h1>
        <p class="text-xl">Mengenal lebih dekat sejarah dan visi misi desa kami</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <div class="order-2 lg:order-1">
                @if($about)
                <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $about->judul ?? 'Desa Langensari' }}</h2>
                <div class="text-gray-600 leading-relaxed text-lg space-y-4">
                    {!! $about->deskripsi ?? '<p>Desa Langensari adalah desa yang terletak di Kecamatan Banyumas dengan masyarakat yang ramah dan gotong royong yang kuat.</p>' !!}
                </div>
                @else
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Desa Langensari</h2>
                <p class="text-gray-600 leading-relaxed text-lg mb-6">
                    Desa Langensari adalah sebuah desa yang terletak di Kecamatan Langensari, Kota banjar, Jawa Barat. 
                    Desa ini dikenal dengan masyarakatnya yang ramah dan semangat gotong royong yang masih sangat kental.
                </p>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Dengan visi menjadi desa yang mandiri, sejahtera, dan berbudaya, kami terus berupaya 
                    meningkatkan kualitas pelayanan kepada masyarakat melalui inovasi dan teknologi.
                </p>
                @endif
                
                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600">{{ App\Models\Penduduk::count() }}+</div>
                        <div class="text-gray-600">Warga Desa</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600">{{ App\Models\Berita::count() }}+</div>
                        <div class="text-gray-600">Berita</div>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2">
                @if($about && $about->gambar)
                <img src="{{ asset('storage/' . $about->gambar) }}" 
                     alt="{{ $about->judul }}" 
                     class="w-full h-96 object-cover rounded-2xl shadow-lg">
                @else
                <div class="w-full h-96 bg-gradient-to-br from-orange-100 to-yellow-100 rounded-2xl shadow-lg flex items-center justify-center">
                    <i class="fa-solid fa-image text-orange-300 text-6xl"></i>
                </div>
                @endif
            </div>
        </div>

        <!-- Visi Misi Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="bg-orange-50 rounded-2xl p-8">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-eye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi Desa</h3>
                <p class="text-gray-600 leading-relaxed">
                    "Menjadi desa yang mandiri, sejahtera, berbudaya, dan berdaya saing melalui pemberdayaan masyarakat 
                    dan pengelolaan sumber daya yang berkelanjutan."
                </p>
            </div>
            
            <div class="bg-yellow-50 rounded-2xl p-8">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-bullseye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi Desa</h3>
                <ul class="text-gray-600 leading-relaxed space-y-2">
                    <li>• Meningkatkan kualitas pelayanan publik</li>
                    <li>• Mengembangkan potensi ekonomi lokal</li>
                    <li>• Melestarikan nilai-nilai budaya</li>
                    <li>• Meningkatkan infrastruktur desa</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Pemerintahan -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Struktur Pemerintahan</h2>
            <p class="text-xl text-gray-600">Tim yang berdedikasi untuk melayani masyarakat</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(App\Models\TenagaKerja::all() as $tenaga)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="h-4 bg-gradient-to-r from-orange-500 to-yellow-500"></div>
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-user-tie text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $tenaga->nama }}</h3>
                    <p class="text-orange-600 font-semibold mb-4">{{ $tenaga->jabatan }}</p>
                    <p class="text-gray-600 text-sm mb-4">{{ $tenaga->bio }}</p>
                    <div class="text-gray-500 text-sm">
                        <i class="fa-solid fa-phone mr-2"></i>{{ $tenaga->kontak }}
                    </div>
                </div>
            </div>
            @endforeach
            
            @if(App\Models\TenagaKerja::count() === 0)
            <div class="col-span-3 text-center py-12">
                <i class="fa-solid fa-users text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600">Data struktur pemerintahan sedang disiapkan</h3>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Sejarah Singkat -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Sejarah Singkat</h2>
            <p class="text-xl text-gray-600">Perjalanan Desa Langensari dari masa ke masa</p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            @php
                $sejarah = App\Models\Sejarah::urutTahun()->get();
            @endphp
            
            @if($sejarah->count() > 0)
            <div class="space-y-8">
                @foreach($sejarah as $item)
                <div class="flex gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ $item->tahun }}
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $item->judul }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $item->isi }}</p>
                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->judul }}" 
                             class="mt-4 rounded-lg w-full max-w-md">
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl">
                <i class="fa-solid fa-book-open text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Sejarah desa sedang ditulis</h3>
                <p class="text-gray-500">Cerita perjalanan desa akan segera tersedia</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection