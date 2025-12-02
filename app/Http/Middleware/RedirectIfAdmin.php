<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // DEBUG: Log user role
        \Log::info('RedirectIfAdmin Middleware', [
            'user' => auth()->user() ? auth()->user()->only(['id', 'name', 'role']) : null,
            'route' => $request->route()->getName(),
            'path' => $request->path()
        ]);

        // Jika user sudah login sebagai Admin / Petugas
        if (auth()->check() && in_array(auth()->user()->role, ['Admin', 'Petugas'])) {
            // IZINKAN akses ke logout
            if ($request->routeIs('logout') || $request->is('logout')) {
                return $next($request);
            }
            
            // Redirect ke admin untuk route lainnya
            return redirect('/admin');
        }

        return $next($request);
    }
}