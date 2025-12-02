<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        return view('frontend.galeri.index', [
            'items' => Galeri::terbaru()->paginate(12)
        ]);
    }
}
