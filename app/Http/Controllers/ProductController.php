<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Blog;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['productImages' => function ($query) {
            $query->where('isPrimary', '1');
        }, 'category'])->paginate(8); //->get();
        $blogs = Blog::all();

        return view('index', compact('products', 'categories', 'blogs'));
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
        }, 'category'])->paginate(9);
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
        $product = Product::with('productImages', 'category')->findOrFail($id);

        return view('products.detail', compact('product'));
    }
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
    public function filterProduct(Request $request)
    {
        $categoryIds = $request->input('categories', []);
        $brandNames = $request->input('brands', []);
        $priceRanges = $request->input('price_ranges', []);
        $sort_price_asc = $request->input('sort_price_asc');
        $sort_price_desc = $request->input('sort_price_desc');
        $sort_name_asc = $request->input('sort_name_asc');
        $sort_name_desc = $request->input('sort_name_desc');
        $products = Product::with(['productImages' => function ($query) {
            $query->where('isPrimary', '1');
        }]);

        if (!empty($categoryIds)) {
            $products = $products->whereIn('category_id', $categoryIds);
        }
        if (!empty($brandNames)) {
            $products = $products->whereIn('brand', $brandNames);
        }
        if ($sort_price_asc) {
            $products = $products->orderBy('price', 'asc');
        }
        if ($sort_price_desc) {
            $products = $products->orderBy('price', 'desc');
        }
        if (!empty($priceRanges)) {
            $products = $products->where(function ($query) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    [$min, $max] = explode('-', $range);
                    $query->orWhereBetween('price', [(int)$min, (int)$max]);
                }
            });
        }
        if ($sort_name_asc) {
            $products = $products->orderBy('name', 'asc');
        }
        if ($sort_name_desc) {
            $products = $products->orderBy('name', 'desc');
        }
        $products = $products->paginate(8);
        $categories = Category::all();
        return view('products.show', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        echo (response()->json($product));
        return response()->json($product);
    }
}
