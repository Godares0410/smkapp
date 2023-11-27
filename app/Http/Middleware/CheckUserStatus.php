<?php

// CheckUserStatus.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        // Periksa status pengguna
        if (Auth::check() && Auth::user()->status == 0) {
            Auth::logout();
            return redirect('/login')->with('gagal', 'Akun Anda dinonaktifkan. Silakan Hubungi Panitia!');
        }

        return $next($request);
    }
}
