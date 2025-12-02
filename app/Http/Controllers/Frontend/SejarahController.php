<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;

class SejarahController extends Controller
{
    public function index()
    {
        return view('frontend.sejarah.index', [
            'items' => Sejarah::urutTahun()->get()
        ]);
    }
}
