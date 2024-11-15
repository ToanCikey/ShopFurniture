<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        if (Auth::check()) {
            if (Auth::user()->role === 'ADM') {
                return $next($request);
            } else {
                session()->flush();
                return redirect()->route('home.index');
            }
        } else {
            session()->flush();
            return redirect()->route('auth.login');
        }
    }
}