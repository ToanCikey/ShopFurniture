<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
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

    public function create()
    {
        $categorys = Category::all();
        return view('admin.product.createproduct')->with("categorys",$categorys);
    }

    public function store(Request $request){
        $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'shortDescription' => 'required',
        'detailDescription' => 'required',
        'brand' => 'required',
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
        'name.required' => 'Vui lòng nhập tên sản phẩm',
        'price.required' => 'Vui lòng nhập giá sản phẩm',
        'price.numeric' => 'Giá phải là một số',
        'quantity.required' => 'Vui lòng nhập số lượng',
        'quantity.integer' => 'Số lượng phải là một số nguyên',
        'shortDescription.required' => 'Vui lòng nhập mô tả ngắn',
        'detailDescription.required' => 'Vui lòng nhập mô tả chi tiết',
        'brand.required' => 'Vui lòng nhập thương hiệu',
        'image.required' => 'Vui lòng chọn ít nhất một ảnh',
        'image.*.image' => 'Tệp tải lên phải là ảnh',
        'image.*.mimes' => 'Ảnh chỉ được có định dạng jpeg, png, jpg, gif',
        'image.*.max' => 'Kích thước ảnh không được vượt quá 2MB',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->shortDescription = $request->input('shortDescription');
        $product->detailDescription = $request->input('detailDescription');
        $product->brand = $request->input('brand');
        $product->sold = 0;
        $product->category_id = $request->input('category_id');
        $product->save();

    if ($request->hasFile('image')) {
    foreach ($request->file('image') as $index => $file) {
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/image/product_imgae'), $fileName); 
        $productImage = new ProductImage();
        $productImage->product_id = $product->id;
        $productImage->imageURL = $fileName;
        $productImage->isPrimary = ($index == 0) ? 1 : 0; 
        $productImage->save();
    }
    }

    return redirect()->route('admin.product.managerproduct')->with('success', 'Sản phẩm đã được thêm thành công!');
    }
}