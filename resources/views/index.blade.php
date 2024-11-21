@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">
    <div class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('assets/image/home/slider_5.png')}}" class="d-block w-100 " alt="Slider 1">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/image/home/slider_6.png')}}" class="d-block w-100" alt="Slider 2">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/image/home/slider_3.png')}}" class="d-block w-100" alt="Slider 3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- main content -->

<!-- card1 -->
<div class="container">
    <h3 class="text-center" style="padding-top: 30px;">SERVICES WE OFFER</h3>
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 py-3 py-md-0">
            <div class="card">
                <img src="{{asset('assets/image/c1.png')}}" alt="" class="card image-top" height="200px">
                <div class="card-body">
                    <h5 class="card-titel text-center">CUSTOM MENUS</h5>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ipsam
                        vitae facere eius modi iure possimus, soluta ea inventore. Omnis!</p>
                    <div id="btn2" class="text-center"><button>View More</button></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
            <div class="card">
                <img src="{{asset('assets/image/c2.png')}}" alt="" class="card image-top" height="200px">
                <div class="card-body">
                    <h5 class="card-titel text-center">SMARTEST WAY</h5>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ipsam
                        vitae facere eius modi iure possimus, soluta ea inventore. Omnis!</p>
                    <div id="btn2" class="text-center"><button>View More</button></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
            <div class="card">
                <img src="{{asset('assets/image/c3.png')}}" alt="" class="card image-top" height="200px">
                <div class="card-body">
                    <h5 class="card-titel text-center">USER FRIENDLEY</h5>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ipsam
                        vitae facere eius modi iure possimus, soluta ea inventore. Omnis!</p>
                    <div id="btn2" class="text-center"><button>View More</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- card1 -->

<!-- card2 -->
<div class="container">
    <div class="row" style="margin-top: 100px;">
        @foreach ($categories as $category)
        <div class="col-md-4 py-3 py-md-0">
            <div class="card mb-4" id="tpc">
                <img src="{{ asset($category->image) }}" alt="" class="card image-top">
                <div class="card-img-overlay">
                    <h4 class="card-titel">{{ $category->name }}</h4>
                    <p class="card-text">Lorem ipsum dolor</p>
                    <div id="btn2"><button>View More</button></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- card2 -->

<!-- card3 -->
<div class="container">
    <h3 class="text-center" style="margin-top: 50px;">TRENDLY PRODUCTS</h3>
    <div class="row" style="margin-top: 50px;">
        @foreach ($products as $product)
        <div class="col-md-3 show-border">
            <a href="{{ route('products.detail', $product->id) }}" class="text-decoration-none text-dark">
                <div class="product-image">
                    <img src="{{asset($product->productImages->first()->imageURL)}}" alt="Tủ áo Maxine">
                </div>
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">{{ number_format($product->price) }} VND</p>
                    <button class="add-to-cart">THÊM VÀO GIỎ</button>
                    <!-- <button class="view-more">XEM THÊM</button> -->
                    <a href="{{ route('products.detail', $product->id) }}" class="btn view-more">XEM THÊM</a>
                </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center"> {{ $products->links() }} </div>
</div>
<!-- card3 -->

<!-- about -->
<div class="container">
    <h1 class="text-center" style="margin-top: 50px;">ABOUT</h1>
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 py-3 py-md-0">
            <div class="card">
                <img src="{{asset('assets/image/about.png')}}" alt="">
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