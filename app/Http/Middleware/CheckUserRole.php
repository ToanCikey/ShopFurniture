<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập và có vai trò là user không
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }

        // Nếu không, chuyển hướng tới trang đăng nhập hoặc một trang khác
        return redirect()->route('auth.login')->with('error', 'Bạn không có quyền truy cập.');
    }
}
