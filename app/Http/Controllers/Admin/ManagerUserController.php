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
        $users = User::paginate(4);
        return view('admin.user.manageruser')->with("users", $users);
    }

    public function create()
    {
        return view('admin.user.createuser');
    }

    public function store(Request $request){
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'hoten' => 'required|string|max:255',
        'role' => 'required|in:USR,ADM',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'email.unique' => 'Email này đã được đăng ký. Vui lòng chọn email khác.',
        'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        'image.required' => 'Vui lòng chọn ảnh đại diện.',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/image/user'), $imageName);
    }
    
    $user = new User();
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password')); 
    $user->name = $request->input('hoten');
    $user->role = $request->input('role');
    $user->image = $imageName ?? null; 
    $user->save();

    return redirect()->route('admin.user.manageruser')->with('success', 'Tài khoản đã được thêm thành công!');
    
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        if ($user->image && file_exists(public_path('assets/image/user/' . $user->image))) {
            unlink(public_path('assets/image/user/' . $user->image));
        }
        $user->delete();
        return redirect()->route('admin.user.manageruser')->with('success', 'Tài khoản đã được xóa thành công!');
    }

    public function edit($id){
        $user = User::find($id);
       return view("admin.user.updateuser")->with("user",$user);
    }

    public function update(Request $request, $id){
    $request->validate([
        'password' => 'nullable|min:6',
        'hoten' => 'required|string|max:255',
        'role' => 'required|in:USR,ADM',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = User::findOrFail($id);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/image/user'), $imageName);

        if ($user->image && file_exists(public_path('assets/image/user/' . $user->image))) {
            unlink(public_path('assets/image/user/' . $user->image));
        }

        $user->image = $imageName;
    }
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }
    $user->name = $request->input('hoten');
    $user->role = $request->input('role');
    $user->save();

    return redirect()->route('admin.user.manageruser')->with('success', 'Tài khoản đã được cập nhật thành công!');
    }

}
