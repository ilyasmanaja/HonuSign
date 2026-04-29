<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login atau role-nya bukan teacher, tendang balik ke dashboard biasa
        if (!auth()->check() || auth()->user()->role !== 'teacher') {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
