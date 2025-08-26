<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ganti dengan logika role admin Anda yang sebenarnya
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect atau abort jika tidak memiliki peran admin
        return redirect()->route('bpjs-ketenagakerjaan'); // atau abort(403);
    }
}