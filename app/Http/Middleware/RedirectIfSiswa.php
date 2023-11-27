<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfSiswa
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('siswa')->check()) {
            return redirect('/menu');
        }

        return $next($request);
    }
}
