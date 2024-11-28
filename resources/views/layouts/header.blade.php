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
                        <a class="nav-link text-white fw-bold px-3" href="#">Top Chair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Chair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Icons -->
        <div class="icons d-flex align-items-center">
            <a href="#" class="text-white mx-2">
                <img src="{{ asset('assets/image/search.png') }}" alt="Search" width="20px">
            </a>
            <a href="#" class="text-white mx-2 cart-icon" id="cart-icon">
                <img src="{{ asset('assets/image/shopping-cart.png') }}" alt="Cart" width="25px">
                <span class="cart-count position-absolute"
                    style="top: -5px; right: -10px; background: red; border-radius: 50%; color: white; padding: 0 5px;"></span>
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
                    <li><a class="dropdown-item" href="#">Settings</a></li>
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartUrl = "{{ route('cart.index') }}"; // Đảm bảo đây là trong view Blade
        console.log(cartUrl); // Kiểm tra giá trị của cartUrl

        const cartIcon = document.getElementById('cart-icon');
        if (cartIcon) {
            cartIcon.addEventListener('click', (event) => {
                event.preventDefault();
                window.location.href = cartUrl; // Sử dụng biến để chuyển hướng
            });
        } else {
            console.error("Cart icon not found");
        }
    });
</script>