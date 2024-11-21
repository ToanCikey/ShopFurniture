@extends('layouts.app')
@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
    @endif
    <div class="row" style="width: 100%;">
        <div class="col-md-12 mb-3">
            <form action="{{ route('products.search') }}" method="GET" class="form-inline">
                <input type="text" name="query" class="form-control mr-sm-2" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-md-3">
            <h5>Danh Mục</h5>
            <ul class="list-group">
                @foreach ($categories as $category) <li class="list-group-item"> <a
                        href="{{ route('products.filter', $category->id) }}">{{ $category->name }}</a> </li> @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <h3 class="text-center">Sản Phẩm</h3>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4 mb-4 show-border">
                    <div class="product-image">
                        <img src="{{ asset($product->productImages->first()->imageURL) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">{{ number_format($product->price) }} VND</p>
                        <button class="add-to-cart">THÊM VÀO GIỎ</button>
                        <button class="view-more">XEM THÊM</button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection