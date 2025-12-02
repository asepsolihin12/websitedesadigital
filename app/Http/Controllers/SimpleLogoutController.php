<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SimpleLogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}