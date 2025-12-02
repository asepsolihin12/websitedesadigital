<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\SejarahController;
use App\Http\Controllers\Frontend\TenagaKerjaController;
use App\Http\Controllers\Frontend\InformasiDesaController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\GaleriController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PengaduanController;
use App\Http\Controllers\Frontend\SuratOnlineController;
use App\Http\Controllers\SimpleLogoutController;

// ---------------------------
// ROUTES UTAMA
// ---------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-desa', [AboutController::class, 'index'])->name('about');
Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah');
Route::get('/tenaga-kerja', [TenagaKerjaController::class, 'index'])->name('tenagaKerja');
Route::get('/informasi-desa', [InformasiDesaController::class, 'index'])->name('informasi');

// Layanan - SEMUA butuh login
Route::middleware(['auth', 'verified'])->group(function () {
    // Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'form'])->name('pengaduan.form');
    Route::post('/pengaduan/kirim', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/riwayat', [PengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
    
    // Surat Online
    Route::get('/surat-online', [SuratOnlineController::class, 'index'])->name('surat-online.index');
    Route::get('/surat-online/buat', [SuratOnlineController::class, 'create'])->name('surat-online.create');
    Route::post('/surat-online/buat', [SuratOnlineController::class, 'store'])->name('surat-online.store');
});

// Berita & Galeri
Route::get('/berita', [BeritaController::class, 'index'])->name('news');
Route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('news.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('gallery');

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak/kirim', [ContactController::class, 'send'])->name('contact.send');

// ---------------------------
// LOGOUT (SIMPLE & CLEAN)
// ---------------------------
Route::get('/simple-logout', [SimpleLogoutController::class, 'logout'])->name('simple.logout');

// ---------------------------
// AUTH BREEZE
// ---------------------------
Route::middleware(['guest'])->group(function () {
    require __DIR__.'/auth.php';
});