<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratOnline;

class SuratOnlineController extends Controller
{
    public function index()
    {
        return view('frontend.surat.index', [
            'list' => SuratOnline::all()
        ]);
    }

    public function create()
    {
        return view('frontend.surat.form');
    }

    public function store(Request $request)
{
    SuratOnline::create([
        'id_user' => auth()->id(),
        'jenis_surat' => $request->jenis_surat,
        'tanggal_pengajuan' => now(),
        'status' => 'Menunggu',
        'keterangan' => $request->keterangan
    ]);

    return back()->with('success', 'Pengajuan surat berhasil dikirim.');
}
}
