<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class ManagerBlogController extends Controller
{
    public function index(){
        $blogs = Blog::paginate(4);
        return view('admin.blog.managerblog')->with("blogs", $blogs);
    }

    public function create(){
        return view('admin.blog.createblog');
    }
    public function store(Request $request){
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'image.required' => 'Vui lòng chọn ảnh .',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/image/blogs'), $imageName);
    }
    
    $blog = new Blog();
    $blog->title = $request->input('title');
    $blog->description = $request->input('description');
    $blog->image = $imageName ?? null; 
    $blog->created_at = now();
    $blog->updated_at = now();
    $blog->save();

    return redirect()->route('admin.blog.managerblog')->with('success', 'Bài viết đã được thêm thành công!');
    }

     public function destroy($id){
        $blog = Blog::findOrFail($id);
        if ($blog->image && file_exists(public_path('assets/image/blogs/' . $blog->image))) {
                unlink(public_path('assets/image/blogs/' . $blog->image));
            }
        $blog->delete();
        return redirect()->route('admin.blog.managerblog')->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function edit($id){
        $blog = Blog::find($id);
       return view("admin.blog.updateblog")->with("blog",$blog);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/image/blogs'), $imageName);

            if ($blog->image && file_exists(public_path('assets/image/blogs/' . $blog->image))) {
                unlink(public_path('assets/image/blogs/' . $blog->image));
            }
            $blog->image = $imageName;
        }
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->updated_at = now();
        $blog->save();

        return redirect()->route('admin.blog.managerblog')->with('success', 'Bài viết đã được cập nhật thành công!');
    }
}
