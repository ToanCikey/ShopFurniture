<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'ADM') {
                return redirect()->route('admin.index');
            }
            return redirect()->route('home.index');
        }
        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput($request->only('username'));
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng

        // Xóa phiên làm việc (session)
        $request->session()->invalidate();

        // Regenerate session ID
        $request->session()->regenerateToken();

        // Chuyển hướng về trang chủ hoặc trang đăng nhập
        return redirect()->route('home.index')->with('success', 'Bạn đã đăng xuất thành công!');
    }
}