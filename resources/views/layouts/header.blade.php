<div class="container">
    <div class="navbar-top">
        <div class="social-link">
            <i><img src="{{ asset('asset/image/twitter.png') }}" alt="" width="30px"></i>
            <i><img src="{{ asset('asset/image/facebook.png') }}" alt="" width="30px"></i>
            <i><img src="{{ asset('asset/image/google-plus.png') }}" alt="" width="30px"></i>
        </div>
        <div class="logo">
            <h3>FURNITURE</h3>
        </div>
        <div class="icons">
            <i><img src="{{ asset('asset/image/search.png') }}" alt="" width="20px"></i>
            <i><img src="{{ asset('asset/image/heart.png') }}" alt="" width="20px"></i>
            <i><img src="{{ asset('asset/image/shopping-cart.png') }}" alt="" width="25px"></i>
            <!-- Đóng thẻ img đúng cách -->
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
                        <a class="nav-link" href="{{route('home.index')}}">Home</a> <!-- Sửa lại class cho chính xác -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
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
                        @guest
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                        @else
                        <a class="nav-link"
                            href="{{ Auth::user()->role== 'ADM' ? route('admin.index') : route('user.account.dashboard') }}">Login</a>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>