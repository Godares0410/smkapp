<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfGuru
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('guru')->check()) {
            return redirect('/gurus');
        }

        return $next($request);
    }
}
