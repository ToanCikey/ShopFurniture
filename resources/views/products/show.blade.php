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
            <form action="{{ route('products.search') }}" method="GET" class="form-inline d-flex justify-content-end">
                <input type="text" name="query" class="form-control form-control-sm mr-2"
                    placeholder="Tìm kiếm sản phẩm..." style="width: 300px;"> <button type="submit"
                    class="btn btn-primary btn-sm">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-md-3">
            <h5>Danh Mục</h5>
            <div class="col-md-12 mb-3 mt-4" style="border-right: 1px solid;">
                <form action="{{ route('products.filterProduct') }}" method="GET" class="form-inline">
                    @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                            id="category_{{ $category->id }}"
                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                    @endforeach
                    <h5 class="mt-3">Thương Hiệu</h5>
                    @php
                    $brands = \App\Models\Product::select('brand')->distinct()->get();
                    @endphp
                    @foreach ($brands as $brand)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand->brand }}"
                            id="brand_{{ $brand->brand }}"
                            {{ in_array($brand->brand, request('brands', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="brand_{{ $brand->brand }}">{{ $brand->brand }}</label>
                    </div>
                    @endforeach
                    <h5 class="mb-3 mt-2">Giá</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sort_price_asc" id="sort_price_asc"
                            {{ request('sort_price_asc') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sort_price_asc">Giá từ thấp đến cao</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sort_price_desc" id="sort_price_desc"
                            {{ request('sort_price_desc') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sort_price_desc">Giá từ cao đến thấp</label>
                    </div>
                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="price_ranges[]"
                            value="0-1000000" id="price_0_1000000"
                            {{ in_array('0-1000000', request('price_ranges', [])) ? 'checked' : '' }}> <label
                            class="form-check-label" for="price_0_1000000">Dưới 1 triệu VND</label> </div>
                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="price_ranges[]"
                            value="1000000-5000000" id="price_1000000_5000000"
                            {{ in_array('1000000-5000000', request('price_ranges', [])) ? 'checked' : '' }}> <label
                            class="form-check-label" for="price_1000000_5000000">1 triệu - 5 triệu VND</label> </div>
                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="price_ranges[]"
                            value="5000000-10000000" id="price_5000000_10000000"
                            {{ in_array('5000000-10000000', request('price_ranges', [])) ? 'checked' : '' }}> <label
                            class="form-check-label" for="price_5000000_10000000">5 triệu - 10 triệu VND</label> </div>
                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="price_ranges[]"
                            value="10000000-20000000" id="price_10000000_20000000"
                            {{ in_array('10000000-20000000', request('price_ranges', [])) ? 'checked' : '' }}> <label
                            class="form-check-label" for="price_10000000_20000000">10 triệu - 20 triệu VND</label>
                    </div>
                    <div class="form-check"> <input class="form-check-input" type="checkbox" name="price_ranges[]"
                            value="20000000-1000000000" id="price_20000000"
                            {{ in_array('20000000-1000000000', request('price_ranges', [])) ? 'checked' : '' }}> <label
                            class="form-check-label" for="price_20000000">Trên 20 triệu VND</label> </div>
                    <h5 class="mb-3 mt-2">Thứ tự chữ cái</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sort_name_asc" id="sort_name_asc"
                            {{ request('sort_name_asc') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sort_name_asc">Tên từ A -> Z</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sort_name_desc" id="sort_name_desc"
                            {{ request('sort_name_desc') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sort_name_desc">Tên từ Z -> A</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Lọc</button>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <h3 class="text-center">Sản Phẩm</h3>
            @if ($products->count() > 0)
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
            @else
            <div class="alert alert-warning">
                Không có sản phẩm nào.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection