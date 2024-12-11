<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManagerCategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::paginate(4);
        return view('admin.category.managercategory')->with("categorys", $categorys);
    }

    public function create()
    {
        return view('admin.category.createcategory');
    }

    public function store(Request $request){
    $request->validate([
        'name' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'image.required' => 'Vui lòng chọn ảnh .',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/image/categoris'), $imageName);
    }

    $category = new Category();
    $category->name = $request->input('name');
    $category->image = $imageName ?? null;
    $category->save();
    return redirect()->route('admin.category.managercategory')->with('success', 'Danh mục đã được thêm thành công!');
    }

    public function destroy($id){
    $category = Category::findOrFail($id);
    if ($category->image && file_exists(public_path('assets/image/categoris/' . $category->image))) {
        unlink(public_path('assets/image/categoris/' . $category->image));
    }
    $category->delete();
    return redirect()->route('admin.category.managercategory')->with('success', 'Danh mục đã được xóa thành công!');
    }

    public function edit($id){
        $category = Category::find($id);
       return view("admin.category.updatecategory")->with("category",$category);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/image/categoris'), $imageName);

            if ($category->image && file_exists(public_path('assets/image/categoris/' . $category->image))) {
                unlink(public_path('assets/image/categoris/' . $category->image));
            }
            $category->image = $imageName;
        }
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('admin.category.managercategory')->with('success', 'Danh mục đã được cập nhật thành công!');
    }
}