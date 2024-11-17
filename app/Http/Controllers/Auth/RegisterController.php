<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Đảm bảo rằng bạn đã sử dụng model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|string|email|unique:users,email'
        ]);

        // Xác thực dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.register')
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => '',
            'role' => 'USR',
        ]);

        return redirect()->route('index')->with('success', 'Đăng ký thành công!');
    }
}
