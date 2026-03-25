<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'siswa') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya siswa yang dapat mengakses.');
    }
}
