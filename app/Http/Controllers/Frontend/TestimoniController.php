<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimoniController extends Controller
{
    public function index()
    {
        return view('frontend.testimoni.index', [
            'list' => Testimonial::terbaru()->get()
        ]);
    }
}
