<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'guru') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya guru yang dapat mengakses.');
    }
}
