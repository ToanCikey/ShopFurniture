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
            return response()->json([
                'message' => 'Sản phẩm đã có trong giỏ hàng.',
                'cartCount' => count($cart)
            ], 200);
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
        // return response()->json(['message' => 'cart updated', 'cartCount' => $sum], 200);
        return response()->json([
            'message' => 'cart updated',
            'cartCount' => $sum
        ], 200);
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
    // public function updateCart(Request $request)
    // {
    //     $product_id = $request->product_id;
    //     $quality = $request->quality;

    //     $product = Product::find($product_id);
    //     if ($product == null) {
    //         return response()->json([
    //             'error' => "San pham khong tim thay"
    //         ], 404);
    //     }
    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$product_id])) {
    //         $cart[$product_id]['quality'] = $quality;
    //     }
    //     session()->put('cart', $cart);
    //     $sum = 0;
    //     foreach ($cart as $item) {
    //         $sum += $item['quality'];
    //     }
    //     return response()->json(['message' => 'cart updated', 'cartCount' => $sum], 200);
    // }
    public function updateCart(Request $request)
    {
        $product_id = $request->product_id;
        $quality = $request->quality;

        // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu không
        $product = Product::find($product_id);
        if ($product == null) {
            return response()->json([
                'error' => "Sản phẩm không tìm thấy"
            ], 404);
        }

        // Kiểm tra xem số lượng có hợp lệ không
        if ($quality < 1) {
            return response()->json([
                'error' => "Số lượng phải lớn hơn 0"
            ], 400);
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quality'] = $quality;
        } else {
            return response()->json([
                'error' => "Sản phẩm không có trong giỏ hàng"
            ], 404);
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $sum = array_sum(array_column($cart, 'quality'));

        return response()->json([
            'message' => 'Giỏ hàng đã được cập nhật',
            'cartCount' => $sum
        ], 200);
    }
}
