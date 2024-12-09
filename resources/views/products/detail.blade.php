    @extends('layouts.app')
    @section('title')
    Detail
    @endsection
    @section('content')
    <div class="container mt-5">
        <div class="title">PRODUCT DETAIL</div>
        <div class="detail">
            <div class="image">
                <img src="{{ asset($product->productImages->first()->imageURL) }}">
                <div class="small-images">
                    @foreach ($product->productImages as $image)
                    <img src="{{ asset($image->imageURL) }}" alt="Additional Image {{ $loop->index + 1}}">
                    @endforeach
                </div>
            </div>
            <div class="content">
                <h1 class="name">{{ $product->name }}</h1>
                <div class="price">{{ number_format($product->price) }} VND</div>
                <div class="buttons">
                    <button><a class="custom-a" href="/">Trờ về</a></button>
                    <button>Thêm Vào Giỏ
                        <span>
                            <svg class="" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                            </svg>
                        </span>
                    </button>
                </div>

                <div class="description">
                    {{ $product->detailDescription}}
                </div>
            </div>
        </div>
    </div>
    @endsection