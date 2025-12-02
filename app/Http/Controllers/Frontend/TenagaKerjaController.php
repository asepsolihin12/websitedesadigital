<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TenagaKerja;

class TenagaKerjaController extends Controller
{
    public function index()
    {
        return view('frontend.tenaga-kerja.index', [
            'list' => TenagaKerja::all()
        ]);
    }
}
