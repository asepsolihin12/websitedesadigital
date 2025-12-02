<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        return view('frontend.berita.index', [
            'berita' => Berita::terbaru()->paginate(8)
        ]);
    }

    public function detail($id)
{
    return view('frontend.berita.detail', [
        'item' => Berita::findOrFail($id)
    ]);
}

}
