<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InformasiDesa;

class InformasiDesaController extends Controller
{
    public function index()
    {
        return view('frontend.informasi.index', [
            'list' => InformasiDesa::terbaru()->get()
        ]);
    }
}
