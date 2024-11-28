<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.manageruser')->with("users",$users);
    }
      public function create()
    {
        return view('admin.user.createuser');
    }
       public function store(Request $request)
    {
       return redirect()->route('admin.user.manageruser');
    }
}