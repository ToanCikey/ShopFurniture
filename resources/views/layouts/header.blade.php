<div class="container-fluid header text-white py-2 custom-header">
    <div class="d-flex justify-content-between align-items-center ">
        <!-- Logo -->
        <div class="logo">
            <h3 class="m-0 fw-bold  text-black">FURNITURE</h3>
        </div>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span><img src="./image/menu.png" alt="Menu" width="30px"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="{{route('index')}}">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="{{route('products.show')}}">Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Tin Tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="{{route('contact')}}">Liên Hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
        @php
        $totalQuantity = 0
        @endphp
        @if(session('cart'))
        @foreach(session('cart') as $item)
        @php
        $totalQuantity += $item['quality'];
        @endphp
        @endforeach
        @endif
        <!-- Icons -->
        <div class="icons d-flex align-items-center">
            <a href="#" class="text-white mx-2">
                <img src="{{ asset('assets/image/search.png') }}" alt="Search" width="20px">
            </a>
            <a href="{{route('cart.index')}}" class="text-white mx-2 cart-icon" id="cart-icon">
                <img src="{{ asset('assets/image/shopping-cart.png') }}" alt="Cart" width="25px">
                <span class="cart-coounts" id="tongsoluong">{{ $totalQuantity }}</span>
            </a>

            <div class="dropdown">
                <div class="text-black mx-2 dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/image/user.png') }}" alt="User" width="20px">
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    @guest
                    <li><a class="dropdown-item" href="{{ route('auth.login') }}">Login</a></li>
                    @else
                    <li><a class="dropdown-item" href="#">{{ Auth::user()->name }}</a></li>
                    <li><a class="dropdown-item" href="{{route('order.index')}}">Đơn hàng của tôi</a></li>
                    <li>
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>