<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.manageruser')->with("users", $users);
    }
    public function create()
    {
        return view('admin.user.createuser');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'hoten' => 'required|string|max:255',
            'role' => 'required|in:USR,ADM',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
        
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); 
        $user->name = $request->input('hoten');
        $user->role = $request->input('role');
        $user->image = $imageName ?? null; 
        $user->save();

        return redirect()->back()->with('success', 'Tài khoản đã được tạo thành công!');
    }
}
