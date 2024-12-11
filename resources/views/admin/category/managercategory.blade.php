@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Categorys</li>
            </ol>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a class="btn btn-success" href="{{ route('admin.category.managercategory.create') }}">Thêm Category</a>
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorys as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td><img src="{{ asset('assets/image/categoris/' . $category->image) }}" alt=""
                                    style="width:50px"></td>
                            <td class="d-flex" style="gap: 10px">
                                <a href="{{ route('admin.category.managercategory.edit', $category->id) }}"
                                    class="btn btn-warning">Update</a>
                                <form action="{{ route('admin.category.managercategory.destroy', $category->id) }}"
                                    method="POST">
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
                {{ $categorys->links() }}
            </div>
        </div>
    </div>
@endsection
