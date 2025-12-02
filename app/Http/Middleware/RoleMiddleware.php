<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login → arahkan ke login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Jika role tidak sesuai → larang akses
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
