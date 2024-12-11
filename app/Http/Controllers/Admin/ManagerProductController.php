<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ManagerProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(4);
        return view('admin.product.managerproduct')->with("products", $products);
    }
}
