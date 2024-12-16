<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalBlogs = Blog::count();
        return view('admin.home')->with("totalUsers",$totalUsers)
                                 ->with("totalProducts",$totalProducts)
                                 ->with("totalOrders",$totalOrders)
                                 ->with("totalBlogs",$totalBlogs);
    }
}