<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['productImages' => function ($query) {
            $query->where('isPrimary', '1');
        }, 'category'])->get();

        return view('index', compact('products', 'categories'));
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}