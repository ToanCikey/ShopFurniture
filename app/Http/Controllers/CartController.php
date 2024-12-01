<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function index()
    {
        return view('cart.index'); // Đảm bảo tên file view là 'cart.blade.php'
    }
    public function addCart(Request $request)
    {
        $product_id = $request->product_id;
        $quality = $request->quality;

        $product = Product::find($product_id);
        if ($product == null) {
            return response()->json([
                'error' => "San pham khong tim thay"
            ], 404);
        }
        $images = $product->productImages;
        $imageURL = !empty($images) && count($images) > 0 ? $images[0]->imageURL : asset('images/default-product.jpg');
        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quality'] += $quality;
        } else {
            $cart[$product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'brand' => $product->brand ?? 'Thương hiệu không xác định',
                'price' => $product->price,
                'material' => $product->material,
                'image' => $imageURL,
                'quality' => $quality
            ];
        }
        session()->put('cart', $cart);
        $sum = 0;
        foreach ($cart as $item) {
            $sum += $item['quality'];
        }
        return response()->json(['message' => 'cart updated', 'cartCount' => $sum], 200);
    }
    public function deleteCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted');
        }
    }
}
