@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a class="btn btn-success" href="{{ route('admin.blog.managerblog.create') }}">Thêm Blog</a>
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th width="5%" scope="col">STT</th>
                        <th width="25%" scope="col">Title</th>
                        <th width="10%" scope="col">Image</th>
                        <th width="13%" scope="col">Date</th>
                        <th width="37%" scope="col">Description</th>
                        <th width="10%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <th scope="row">{{ $blog->id }}</th>
                            <td>{{ Str::limit($blog->title, 50, '...') }}</td>
                            <td><img src="{{ asset('assets/image/blogs/' . $blog->image) }}" alt=""
                                    style="width:50px"></td>
                            <td>{{ \Carbon\Carbon::parse($blog->created_at)->format('d-m-Y') }}</td>
                            <td>{{ Str::limit($blog->description, 50, '...') }}</td>
                            <td class="d-flex" style="gap: 10px">
                                <a href="{{ route('admin.blog.managerblog.edit', $blog->id) }}"
                                    class="btn btn-warning">Update</a>
                                <form action="{{ route('admin.blog.managerblog.destroy', $blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection
