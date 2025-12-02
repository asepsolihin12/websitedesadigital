<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        return view('frontend.about', [
            'about' => About::first()
        ]);
    }
}
