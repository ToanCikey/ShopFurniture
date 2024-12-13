    @extends('layouts.app')
    @section('title')
    Detail
    @endsection
    @section('content')
    <div class="container mt-5">
        <div class="title">PRODUCT DETAIL</div>
        <div>
            <button>
                <a class="custom-a" href="/" style="position: absolute; top: 100px; left: 100px; z-index: 9;">
                    <i class="fa-solid fa-backward" style="margin-right: 10px;"></i>Trở Về
                </a>
            </button>

        </div>
        <div class="detail">
            <div class="image">
                <img src="{{ asset('assets/image/product_image/' . $product->productImages->first()->imageURL) }}">
                <div class="small-images">
                    @foreach ($product->productImages as $image)
                    <img src="{{ asset('assets/image/product_image/' . $image->imageURL) }}"
                        alt="Additional Image {{ $loop->index + 1}}">
                    @endforeach
                </div>
            </div>
            <div class="content">
                <h1 class="name">{{ $product->name }}</h1>
                <div class="price">{{ number_format($product->price) }} VND</div>
                <div class="details">
                    <p><strong>Thương hiệu:</strong> {{ $product->brand }}</p>
                    <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
                    <p><strong>Đã bán:</strong> {{ $product->sold }}</p>
                    <p><strong>Chất liệu:</strong> {{ $product->material }}</p>
                </div>
                <div class="description">
                    {{ $product->detailDescription}}
                </div>
                <div class="buttons">
                    <button class="add-to-cart" type="button" data-id="{{ $product->id }}" data-quality="1">
                        THÊM VÀO GIỎ
                    </button>
                </div>

            </div>
        </div>
        <div class="related-products mt-5">
            <h2 style="text-align: center;">Có Thể Bạn Sẽ Ghiền</h2>
            <div class="row" style="margin-top: 50px; width: 100%;">
                @foreach ($relatedProducts as $product)
                <div class="col-md-3 show-border">
                    <a href="{{ route('products.detail', $product->id) }}" class="text-decoration-none text-dark">
                        <div class="product-image">
                            <img src="{{ asset('assets/image/product_image/' . $product->productImages->first()->imageURL) }}"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <div class="product-text">
                                <p class="material">Chất liệu: {{ $product->material }}</p>
                                <p class="price" style="font-weight: 200;">Giá: {{ number_format($product->price) }} VND
                                </p>
                            </div>
                            <button class="add-to-cart" type="button" data-id="{{ $product->id }}" data-quality="1">THÊM
                                VÀO GIỎ</button>
                            <button class="view-more">
                                <a href="{{ route('products.detail', $product->id) }}" class="text-decoration-none">XEM
                                    THÊM</a>
                            </button>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Lấy tất cả các nút "Add to Cart"
            const all_addtocart = document.querySelectorAll('.add-to-cart');
            // Duyệt qua từng nút
            all_addtocart.forEach(bt => {
                bt.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    axios.post("{{ route('add-product-cart') }}", {
                            product_id: bt.dataset.id,
                            quality: bt.dataset.quality
                        })
                        .then(response => {
                            // Hiển thị thông tin giỏ hàng sau khi thêm thành công
                            alert(response.data.message);
                            // Cập nhật số lượng sản phẩm trong giỏ hàng
                            const cartCountElement = document.querySelector('#tongsoluong');
                            if (cartCountElement) {
                                cartCountElement.innerText = response.data.cartCount;
                            }
                        })
                        .catch(error => {
                            // Xử lý lỗi khi thêm sản phẩm vào giỏ hàng
                            console.error('Lỗi khi thêm vào giỏ hàng:', error.response ? error
                                .response.data : error.message);
                        });
                });
            });
        });
    </script>
    @endpush