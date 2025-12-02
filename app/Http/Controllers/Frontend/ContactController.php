<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function send(Request $request)
    {
        ContactUs::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'tanggal' => now()
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
