<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function form()
    {
        return view('frontend.pengaduan.form');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
    ]);

    // Langsung pakai auth()->id() karena sudah diproteksi middleware
    Pengaduan::create([
        'id_user' => auth()->id(), // Selalu ada karena middleware auth
        'judul' => $request->judul,
        'isi' => $request->isi,
        'tanggal' => now(),
        'status' => 'Menunggu'
    ]);

    return back()->with('success', 'Pengaduan berhasil dikirim.');
}

    public function cekStatus()
    {
        return view('frontend.pengaduan.cek-status');
    }

    public function getStatus(Request $request)
    {
        $data = Pengaduan::where('judul', $request->judul)->first();
        return view('frontend.pengaduan.hasil-status', ['item' => $data]);
    }

    public function riwayat()
    {
        return view('frontend.pengaduan.riwayat', [
            'list' => Pengaduan::byUser(auth()->id())->get()
        ]);
    }
}
