<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengaduan;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
{
    return view('frontend.home', [
        'hero'        => \App\Models\Hero::first(),
        'berita'      => \App\Models\Berita::latest()->take(3)->get(),
        'galeri'      => \App\Models\Galeri::latest()->take(8)->get(),
        'testimoni'   => \App\Models\Testimonial::latest()->take(6)->get(),
        'infoDesa'    => \App\Models\InformasiDesa::first(),
        'sosmed'      => \App\Models\MediaSocial::first(),
    ]);
}


}
