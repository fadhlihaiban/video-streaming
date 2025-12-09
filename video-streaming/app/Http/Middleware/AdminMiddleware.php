<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki level 'admin'
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, redirect ke dashboard atau tampilkan 403 Forbidden
        return redirect('/dashboard')->with('error', 'Akses ditolak. Anda bukan Admin.');
    }
}
