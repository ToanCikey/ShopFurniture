@extends('layouts.app')
@section('title')
Furniture
@endsection
@section('content')
<div class="container-fluid p-0">
    <div class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/image/home/slider_5.png') }}" class="d-block w-100 " alt="Slider 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/home/slider_6.png') }}" class="d-block w-100" alt="Slider 2">
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/image/home/slider_5.png') }}" class="d-block w-100 " alt="Slider 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/image/home/slider_6.png') }}" class="d-block w-100" alt="Slider 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/image/home/slider_3.png') }}" class="d-block w-100" alt="Slider 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- main content -->

    <!-- card1 -->
    <div class="container">
        <h3 class="text-center" style="padding-top: 30px;">TIN TỨC</h3>
        <div class="row" style="margin-top: 50px;">
            @foreach ($blogs as $blog)
            <div class="col-md-4 py-3 py-md-0">
                <div class="card" style="height: 400px;">
                    <img src="{{ asset('assets/image/blogs/' . $blog->image) }}" alt="" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <!-- Hiển thị ngày tháng theo định dạng mong muốn -->
                        <p class="card-text" style="padding-left: 14px; font-size: 14px; color: #6c757d;">
                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y H:i') }}
                        </p>
                        <p class="text-center" style="font-weight: bold; font-size: 18px;">{{ $blog->title }}</p>
                        <div id="btn2" class="text-center mt-3">
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary">
                                Xem Thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- card1 -->

    <!-- card2 -->
    <div class="container">
        <h3 class="text-center" style="margin-top: 50px;">DANH MỤC</h3>
        <div class="categories">
            @foreach ($categories as $category)
            <div class="category">
                <img src="{{ asset('assets/image/categoris/' . $category->image) }}" alt="{{ $category->name }}">
                <h3>{{ $category->name }}</h3>
            </div>
            @endforeach
        </div>
    </div>
    <!-- card2 -->

    <!-- card3 -->
    <div class="container">
        <h3 class="text-center" style="margin-top: 50px;">SẢN PHẨM XU HƯỚNG</h3>
        <div class="row" style="margin-top: 50px; width: 100%;">
            @foreach ($products as $product)
            <div class="col-md-3 show-border">
                <a href="{{ route('products.detail', $product->id) }}" class="text-decoration-none text-dark">
                    <div class="product-image">
                        <img src="{{ asset($product->productImages->first()->imageURL) }}" alt="Tủ áo Maxine">
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <div class="product-text">
                            <p class="material">Chất liệu: {{ $product->material }}</p>
                            <p class="price" style="font-weight: 200;">Giá: {{ number_format($product->price) }}
                                VND
                            </p>
                        </div>
                        <!-- <input type="hidden" class="quality" value="1"> -->
                        <button class="add-to-cart" type="button" data-id="{{ $product->id }}" data-quality="1">THÊM VÀO
                            GIỎ</button>
                        <button class="view-more">
                            <a href="{{ route('products.detail', $product->id) }}">XEM THÊM</a>
                        </button>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>

    <!-- card3 -->

    <!-- about -->
    <!-- <div class="container">
        <h1 class="text-center" style="margin-top: 50px;">ABOUT</h1>
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-6 py-3 py-md-0">
                <div class="card">
                    <img src="{{ asset('assets/image/about.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-6 py-3 py-md-0">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum, saepe possimus quo, quasi animi
                    natus nulla beatae neque soluta pariatur id ducimus eum, sed quis enim minima? Fugiat delectus quo
                    optio nemo voluptatem ullam officiis neque exercitationem tenetur eum corporis quas in esse
                    blanditiis, quasi animi nam eos! Tempora deleniti eligendi magni ex voluptatum ut dicta nemo et
                    consequuntur distinctio quae atque porro inventore assumenda, nihil odio iusto accusamus libero
                    error nam aut, at praesentium cum reiciendis. Possimus consequatur obcaecati at illum in dolores
                    earum vero ipsum. Ipsam vitae adipisci corrupti totam vel consequuntur fugiat. Perferendis fuga
                    doloremque tempora, in eos, voluptates iure, optio qui modi ex ea saepe. Eum perspiciatis,
                    voluptates fugiat nesciunt corrupti minima aliquam repellat, ea quasi natus, recusandae aut nobis
                    modi. Commodi, alias reiciendis reprehenderit hic soluta consectetur corporis accusantium placeat,
                    totam minima nostrum magnam dolorum aut dolore, sapiente ea. Magni est quo ipsam nisi iste.</p>
                <div id="btn4"><button>Read More...</button></div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <section class="about_section layout_padding-bottom" style="margin-left: 80px;">
            <div class="container  ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h2>
                                    Vẻ Đẹp Từ <span>Nội Thất</span>
                                </h2>
                            </div>
                            <p>
                                Nội thất không chỉ là những vật dụng hữu ích trong cuộc sống hàng ngày mà còn đóng vai
                                trò quan trọng trong việc nâng cao tính thẩm mỹ của không gian sống. Một căn phòng được
                                bài trí hài hòa và tinh tế sẽ mang lại cảm giác dễ chịu và thư giãn cho người ở, biến
                                mỗi căn nhà trở thành tổ ấm thật sự. Sự lựa chọn nội thất phù hợp còn thể hiện được cá
                                tính và phong cách sống của chủ nhân, tạo nên dấu ấn riêng biệt.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="img-box">
                            <img src="assets/image/card8.png" alt="">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="img-box">
                            <img src="assets/image/card8.png" alt="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h2>
                                    Vẻ Đẹp Từ <span>Nội Thất</span>
                                </h2>
                            </div>
                            <p>
                                Nội thất không chỉ là những vật dụng hữu ích trong cuộc sống hàng ngày mà còn đóng vai
                                trò quan trọng trong việc nâng cao tính thẩm mỹ của không gian sống. Một căn phòng được
                                bài trí hài hòa và tinh tế sẽ mang lại cảm giác dễ chịu và thư giãn cho người ở, biến
                                mỗi căn nhà trở thành tổ ấm thật sự. Sự lựa chọn nội thất phù hợp còn thể hiện được cá
                                tính và phong cách sống của chủ nhân, tạo nên dấu ấn riêng biệt.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                    console.log('Sản phẩm đã được thêm vào giỏ:', response.data);
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