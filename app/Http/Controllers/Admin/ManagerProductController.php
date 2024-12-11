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

    public function destroy($id){
        $product = Product::find($id);

    if ($product) {
        $productImages = $product->productImages;
        if ($productImages->isEmpty()) {
            return redirect()->route('admin.product.managerproduct')->with('error', 'Sản phẩm không có ảnh để xóa.');
        }
        foreach ($productImages as $image) {
            $imagePath = public_path('assets/image/product_imgae/' . $image->imageURL);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }
         $product->delete();
        return redirect()->route('admin.product.managerproduct')->with('success', 'Sản phẩm xóa thành công.');
    } else {
        return redirect()->route('admin.product.managerproduct')->with('error', 'Sản phẩm không tồn tại.');
    }
    }
}
