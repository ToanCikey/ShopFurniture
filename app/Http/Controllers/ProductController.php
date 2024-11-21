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
        }, 'category'])->paginate(8); //->get();

        return view('index', compact('products', 'categories'));
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function showProducts()
    {
        $categories = Category::all();
        $products = Product::with(['productImages' => function ($query) {
            $query->where('isPrimary', '1');
        }, 'category'])->paginate(8);
        return view('products.show', compact('products', 'categories'));
    }
    public function filterByCategory($categoryId)
    {
        $categories = Category::all();
        $products = Product::with(['productImages' => function ($query) {
            $query->where('isPrimary', '1');
        }, 'category'])->where('category_id', $categoryId)->paginate(8);
        return view('products.show', compact('products', 'categories'));
    }
    public function detail($id)
    {
        $product = Product::with('productImages')->findOrFail($id);
        return view('products.detail', compact('product'));
    }
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     if (empty($query)) {
    //         return redirect()->route('products.show')->with('message', 'Vui lòng nhập từ khóa tìm kiếm.');
    //     }

    //     $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(8);
    //     $categories = Category::all();

    //     return view('products.show', compact('products', 'categories'));
    // }
    public function search(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            return redirect()->route('products.show')->with('message', 'Vui lòng nhập từ khóa tìm kiếm.');
        }
        $products = Product::with(['productImages' => function ($query) {
            $query->where('isPrimary', '1');
        }])->where('name', 'LIKE', '%' . $query . '%')->paginate(8);
        if ($products->isEmpty()) {
            return redirect()->route('products.show')->with('message', 'Không tìm thấy sản phẩm nào với từ khóa: ' . $query);
        }
        $categories = Category::all();
        return view('products.show', compact('products', 'categories'));
    }
}
