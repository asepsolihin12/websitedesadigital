@extends('frontend.layout.app')

@section('title', 'Surat Online - Desa Langensari')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Surat Online</h1>
        <p class="text-lg">Ajukan pembuatan surat administrasi secara online</p>
    </div>
</section>

<!-- Surat Online Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Header dengan Statistik -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Pengajuan Surat Anda</h2>
                <p class="text-gray-600">Kelola semua pengajuan surat dalam satu tempat</p>
            </div>
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                <div class="text-center">
                    <div class="text-2xl font-bold text-orange-600">{{ $list->where('status', 'Menunggu')->count() }}</div>
                    <div class="text-gray-600 text-sm">Menunggu</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $list->where('status', 'Diterima')->count() }}</div>
                    <div class="text-gray-600 text-sm">Diterima</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $list->where('status', 'Ditolak')->count() }}</div>
                    <div class="text-gray-600 text-sm">Ditolak</div>
                </div>
            </div>
        </div>

        <!-- Action Button untuk buka modal -->
        <div class="mb-6">
            <button onclick="openModal()"
               class="bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 inline-flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Buat Pengajuan Surat Baru
            </button>
        </div>

        @if($list->count() > 0)
        <!-- Table List -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Surat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pengajuan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($list as $surat)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $surat->jenis_surat }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ $surat->tanggal_pengajuan->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                    @if($surat->status == 'Menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($surat->status == 'Diterima') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $surat->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ $surat->keterangan ?? '-' }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card View untuk Mobile -->
        <div class="lg:hidden space-y-4 mt-6">
            @foreach($list as $surat)
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="font-semibold text-gray-800">{{ $surat->jenis_surat }}</h3>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        @if($surat->status == 'Menunggu') bg-yellow-100 text-yellow-800
                        @elseif($surat->status == 'Diterima') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $surat->status }}
                    </span>
                </div>
                <div class="text-sm text-gray-600 mb-2">
                    <i class="fa-solid fa-calendar mr-2"></i>
                    {{ $surat->tanggal_pengajuan->format('d M Y') }}
                </div>
                @if($surat->keterangan)
                <div class="text-sm text-gray-600">
                    <i class="fa-solid fa-note-sticky mr-2"></i>
                    {{ $surat->keterangan }}
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 max-w-md mx-auto">
                <i class="fa-solid fa-file-contract text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Pengajuan</h3>
                <p class="text-gray-500 mb-4">Anda belum mengajukan pembuatan surat</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Modal Form -->
<div id="suratModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Ajukan Surat Baru</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <i class="fa-solid fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('surat-online.store') }}" method="POST" id="suratForm">
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
                <div class="flex gap-4 justify-end">
                    <button type="button" onclick="closeModal()" 
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700 transition duration-300 flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        Ajukan Surat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Info Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Jenis Surat yang Tersedia</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-orange-50 rounded-xl p-6 text-center">
                    <i class="fa-solid fa-user text-orange-600 text-2xl mb-3"></i>
                    <h4 class="font-semibold text-gray-800 mb-2">Surat Keterangan</h4>
                    <p class="text-gray-600 text-sm">Surat keterangan domisili, tidak mampu, dll</p>
                </div>
                <div class="bg-orange-50 rounded-xl p-6 text-center">
                    <i class="fa-solid fa-home text-orange-600 text-2xl mb-3"></i>
                    <h4 class="font-semibold text-gray-800 mb-2">Surat Domisili</h4>
                    <p class="text-gray-600 text-sm">Keterangan tempat tinggal</p>
                </div>
                <div class="bg-orange-50 rounded-xl p-6 text-center">
                    <i class="fa-solid fa-business-time text-orange-600 text-2xl mb-3"></i>
                    <h4 class="font-semibold text-gray-800 mb-2">Surat Usaha</h4>
                    <p class="text-gray-600 text-sm">Keterangan tempat usaha</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Modal Functions
    function openModal() {
        document.getElementById('suratModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('suratModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('suratModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Reset form when modal closes
    document.getElementById('suratModal').addEventListener('hidden', function() {
        document.getElementById('suratForm').reset();
    });

    // Auto close modal on successful submission (jika perlu)
    @if(session('success'))
    setTimeout(() => {
        closeModal();
    }, 2000);
    @endif
</script>
@endpush