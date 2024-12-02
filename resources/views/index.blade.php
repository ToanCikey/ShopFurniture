@extends('layouts.app')
@section('title')
    Furniture
@endsection
@section('content')
<<<<<<< HEAD

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
                    <img src="{{asset('assets/image/home/slider_5.png')}}" class="d-block w-100 " alt="Slider 1">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('assets/image/home/slider_6.png')}}" class="d-block w-100" alt="Slider 2">
=======
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
>>>>>>> f14978b0edd05fd704594a2d4aae7517537b0fd4
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
                    <div class="card" style="height: 600px;">
                        <img src="{{ $blog->image }}" alt="" class="card image-top" style="height: 200px;">
                        <div class="card-body">
                            <!-- <h5 class="card-titel text-center">{{ $blog->description }}</h5> -->
                            <p style="padding-left: 14px;">{{ $blog->date }}</p>
                            <p class="text-center">{{ $blog->description }}</p>
                            <div id="btn2" class="text-center">
                                <button><a href="{{ route('blogs.show', $blog->id) }}"
                                        style="color: black; 
                        text-decoration: none;">Xem
                                        Thêm</a></button>
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
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                    <h3>{{ $category->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
    <!-- card2 -->

    <!-- card3 -->
    <!-- <div class="container">
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
                                        <p class="price" style="font-weight: 200;">Giá: {{ number_format($product->price) }} VND</p>
                                    </div>
                                    <button class="add-to-cart">THÊM
                                        VÀO GIỎ</button>
                                    <button class="view-more">
                                        <a href="{{ route('products.detail', $product->id) }}">XEM THÊM</a>
                                    </button>

                                </div>
                            </a>

                        </div>
    @endforeach
                    </div>
                    {{ $products->links() }}
                </div> -->
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
                                <p class="price" style="font-weight: 200;">Giá: {{ number_format($product->price) }} VND
                                </p>
                            </div>
                            <!-- <input type="hidden" class="quality" value="1"> -->
                            <button class="add-to-cart" type="button" data-id="{{ $product->id }}"
                                data-quality="1">THÊM VÀO
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
    <div class="container">
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
    </div>
@endsection
@push('scripts')
<<<<<<< HEAD
<!-- <script>
    const all_addtocart = document.querySelectorAll('.add-to-cart');
    all_addtocart.forEach(bt => {
        // alert("click m3");
        bt.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                if (!isLoggedIn) {
                    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
                    window.location.href = "{{ route('login') }}";
                } else {
                    axios.post("{{ route('add-product-cart')}}", {
                            product_id: bt.dataset.id,
                            quality: bt.dataset.quality
                        })
                        .then(response => {
                            console.log(response);
                            document.querySelector('#tongsoluong').innerText = response.data.cartCount
                        })
                        .catch(error => {
                            console.error('Error adding to cart:', error.response ? error.response.data : error
                                .message);
                        })
                })

            }

    });
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Lấy tất cả các nút "Add to Cart"
        const all_addtocart = document.querySelectorAll('.add-to-cart');

        // Duyệt qua từng nút
        all_addtocart.forEach(bt => {
            bt.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

=======
    <script>
        const all_addtocart = document.querySelectorAll('.add-to-cart');
        all_addtocart.forEach(bt => {
            // alert("click m3");
            bt.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                // console.log(bt.dataset.id);
                // console.log(bt.dataset.quality);
>>>>>>> f14978b0edd05fd704594a2d4aae7517537b0fd4

                axios.post("{{ route('add-product-cart') }}", {
                        product_id: bt.dataset.id,
                        quality: bt.dataset.quality
                    })
                    .then(response => {
<<<<<<< HEAD
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
=======
                        console.log(response);
                        document.querySelector('#tongsoluong').innerText = response.data.cartCount
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error.response ? error.response.data :
                            error
                            .message);
                    })
            })
        });
    </script>
@endpush
>>>>>>> f14978b0edd05fd704594a2d4aae7517537b0fd4
