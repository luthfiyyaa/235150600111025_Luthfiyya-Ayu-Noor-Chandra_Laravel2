<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        return $next($request);
    }
}
