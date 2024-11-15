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
            <i><img src="{{ asset('assets/image/heart.png') }}" alt="" width="20px"></i>
            <i><img src="{{ asset('assets/image/shopping-cart.png') }}" alt="" width="25px"></i>
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
                        <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                        <!-- @guest
                        <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                        @else
                        <a class="nav-link"
                            href="{{ Auth::user()->role== 'ADM' ? route('admin.index') : route('user.account.dashboard') }}">Login</a>
                        @endguest -->
                        <!-- @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                        </form>
                    </li>
                    @endguest -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>