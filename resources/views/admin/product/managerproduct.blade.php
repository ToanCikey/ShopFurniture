@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a class="btn btn-success" href="{{ route('admin.product.managerproduct.create') }}">Thêm Product</a>
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th width="5%" scope="col">STT</th>
                        <th width="25%" scope="col">Name</th>
                        <th width="5%" scope="col">Quantity</th>
                        <th width="15%" scope="col">Price</th>
                        <th width="15%" scope="col">ShortDescription</th>
                        <th width="15%" scope="col">DetailDescription</th>
                        <th width="10%" scope="col">Brand</th>
                        <th width="10%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                            <td>{{ Str::limit($product->shortDescription, 30, '...') }}</td>
                            <td>{{ Str::limit($product->detailDescription, 30, '...') }}</td>
                            <td>{{ $product->brand }}</td>
                            <td class="d-flex" style="gap: 10px">
                                <a href="{{ route('admin.product.managerproduct.edit', $product->id) }}"
                                    class="btn btn-warning">Update</a>
                                <form action="{{ route('admin.product.managerproduct.destroy', $product->id) }}"
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
