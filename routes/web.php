<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Middleware\AuthAdmin;
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

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
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
