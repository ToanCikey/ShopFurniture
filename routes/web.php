<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManagerBlogController;
use App\Http\Controllers\Admin\ManagerCategoryController;
use App\Http\Controllers\Admin\ManagerOrderController;
use App\Http\Controllers\Admin\ManagerProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ManagerUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GHNController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\LoginFacebookController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login-auth', [HomeController::class, 'login'])->name('auth.login');
Route::post('/postLogin', [LoginController::class, 'login'])->name('auth.login.submit');

//dangky
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.submit');
//dang xuat
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/account-dash', [UserController::class, 'account_dashboard'])->name('user.account.dashboard');
});

Route::get('/', [CategoryController::class, 'index'])->name('index');
Route::get('/', [ProductController::class, 'index'])->name('index');

//Products
Route::get('/products', [ProductController::class, 'showProducts'])->name('products.show');
Route::get('/products/category/{category}', [ProductController::class, 'filterByCategory'])->name('products.filter');

//Detail
Route::get('/products/{product}', [ProductController::class, 'detail'])->name('products.detail');

//Search
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
//Fiter product
Route::get('/filterProduct', [ProductController::class, 'filterProduct'])->name('products.filterProduct');
//Detail Blog
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blog', [BlogController::class, 'showAll'])->name('blog');

//Cart
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/delete-cart-product', [CartController::class, 'deleteCart'])->name('delete-product-cart');
    Route::post('/update-cart-product', [CartController::class, 'updateCart'])->name('update-product-cart');
});

Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('add-product-cart');


//checkout
Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout');
Route::get('/orderSuccess', [OrderController::class, 'index'])->name('order.index');
Route::get('/orderAlter', [OrderController::class, 'success'])->name('order.success');

//momo
Route::post('/momo_payment', [OrderController::class, 'momo_payment'])->name('momo_payment');
//vnpay


//contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendmail']);

Route::middleware(['auth', AuthAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    // Route cho trang Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');
    // Route cho Quản lý người dùng
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [ManagerUserController::class, 'index'])->name('manageruser');
        Route::get('/create', [ManagerUserController::class, 'create'])->name('manageruser.create');
        Route::post('/', [ManagerUserController::class, 'store'])->name('manageruser.store');
        Route::delete('/{id}', [ManagerUserController::class, 'destroy'])->name('manageruser.destroy');
        Route::get('/{id}/edit', [ManagerUserController::class, 'edit'])->name('manageruser.edit');
        Route::put('/{id}', [ManagerUserController::class, 'update'])->name('manageruser.update');
    });
    // Route cho Quản lý bài viết
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [ManagerBlogController::class, 'index'])->name('managerblog');
        Route::get('/create', [ManagerBlogController::class, 'create'])->name('managerblog.create');
        Route::post('/', [ManagerBlogController::class, 'store'])->name('managerblog.store');
        Route::delete('/{id}', [ManagerBlogController::class, 'destroy'])->name('managerblog.destroy');
        Route::get('/{id}/edit', [ManagerBlogController::class, 'edit'])->name('managerblog.edit');
        Route::put('/{id}', [ManagerBlogController::class, 'update'])->name('managerblog.update');
    });
    // Quản lý đơn hàng
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [ManagerOrderController::class, 'index'])->name('managerorder');
        Route::get('/show/{id}', [ManagerOrderController::class, 'show'])->name('managerorder.show');
        Route::delete('/{id}', [ManagerOrderController::class, 'destroy'])->name('managerorder.destroy');
        Route::get('/{id}/edit', [ManagerOrderController::class, 'edit'])->name('managerorder.edit');
        Route::put('/{id}', [ManagerOrderController::class, 'update'])->name('managerorder.update');
    });
    // Quản lý sản phẩm
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ManagerProductController::class, 'index'])->name('managerproduct');
        Route::get('/create', [ManagerProductController::class, 'create'])->name('managerproduct.create');
        Route::post('/', [ManagerProductController::class, 'store'])->name('managerproduct.store');
        Route::delete('/{id}', [ManagerProductController::class, 'destroy'])->name('managerproduct.destroy');
        Route::get('/{id}/edit', [ManagerProductController::class, 'edit'])->name('managerproduct.edit');
        Route::put('/{id}', [ManagerProductController::class, 'update'])->name('managerproduct.update');
    });
    // Quản lý danh mục sản phẩm
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [ManagerCategoryController::class, 'index'])->name('managercategory');
        Route::get('/create', [ManagerCategoryController::class, 'create'])->name('managercategory.create');
        Route::post('/', [ManagerCategoryController::class, 'store'])->name('managercategory.store');
        Route::delete('/{id}', [ManagerCategoryController::class, 'destroy'])->name('managercategory.destroy');
        Route::get('/{id}/edit', [ManagerCategoryController::class, 'edit'])->name('managercategory.edit');
        Route::put('/{id}', [ManagerCategoryController::class, 'update'])->name('managercategory.update');
    });
});


// login by gg
Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);


//login by fb
Route::get('auth/facebook', [LoginFacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [LoginFacebookController::class, 'handleFacebookCallback']);


//ghn
//lay ds tỉnh thành
Route::get('/provinces', [GHNController::class, 'getProvinces']);
//lay ds quận/huyện
Route::get('/districts/{province_id}', [GHNController::class, 'getDistricts']);
//lay ds phường/xã
Route::get('/wards/{district_id}', [GHNController::class, 'getWards']);
// lay danh sach service-id
Route::post('/serviceid', [GHNController::class, 'getAvailableServices']);
// tao don hang
Route::post('/create_order', [GHNController::class, 'createOrder']);
// tinh phi ship
Route::post('/calculate-shipping', [GHNController::class, 'calculateShipping']);
//Trạng thái đơn hàng
// Route::get('/api/order-status/{orderId}', function ($orderId) {
//     $token = env('GHN_API_KEY');

//     $response = Http::withHeaders([
//         'Token' => $token
//     ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/detail', [
//         'order_code' => $orderId
//     ]);

//     $data = $response->json();

//     if ($response->successful() && isset($data['data']['status'])) {
//         return response()->json([
//             'success' => true,
//             'status' => $data['data']['status']
//         ]);
//     } else {
//         return response()->json([
//             'success' => false,
//             'message' => 'Không lấy được trạng thái đơn hàng'
//         ], 400);
//     }
// });


Route::get('/api/order-status/{orderCode}', [GHNController::class, 'getOrderStatus']);
//Huỷ đơn hàng
Route::post('/api/cancel-order/{orderCode}', [GHNController::class, 'cancelOrder']);
