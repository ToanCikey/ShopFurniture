<div class="container">
    <div class="navbar-top">
        <div class="social-link">
            <i><img src="{{ asset('assets/image/twitter.png') }}" alt="" width="30px"></i>
            <i><img src="{{ asset('assets/image/facebook.png') }}" alt="" width="30px"></i>
            <i><img src="{{ asset('assets/image/google-plus.png') }}" alt="" width="30px"></i>
        </div>
        <div class="logo">
            <h3>FURNITURE</h3>
        </div>
        <div class="icons">
            <i><img src="{{ asset('assets/image/search.png') }}" alt="" width="20px"></i>
            <i><img src="{{ asset('assets/image/shopping-cart.png') }}" alt="" width="25px"></i>
            <div class="user-icon">
                <i><img src="{{ asset('assets/image/user.png') }}" alt="" width="20px"></i>
                <div class="dropdown-menu">
                    <ul>
                        @guest
                        <li><a href="{{ route('auth.login') }}">Login</a></li>
                        @else
                        <li><a href="#">{{ Auth::user()->name }}</a></li>
                        <li><a href="#">Settings</a></li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout-button">Logout</button>
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <nav class="navbar navbar-expand-md" id="navbar-color">
        <div class="container">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span><i><img src="./image/menu.png" alt="" width="30px"></i></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Trang Chủ</a> <!-- Sửa lại class cho chính xác -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('products.show')}}">Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Top Chair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>