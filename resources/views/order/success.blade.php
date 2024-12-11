@extends('layouts.app')
@section('title')
Order Success
@endsection
@section('content')
<style>
    .thank-you-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        background-color: #f5f5f5;
        color: #333;
        text-align: center;
        padding: 50px;
        border-radius: 10px;
    }

    .thank-you-message {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: auto;
    }

    .thank-you-message h1 {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: #333;
    }

    .thank-you-message h2 {
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: #666;
    }

    .thank-you-message h3 {
        font-size: 1.2rem;
        margin-bottom: 20px;
        color: #999;
    }

    .btn-check-orders {
        display: inline-block;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        color: #ffffff;
        background-color: #333;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-check-orders:hover {
        background-color: #555;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container thank-you-container" style="margin-top: 100px;">
    <div class="thank-you-message">
        <h1>Cảm ơn bạn đã mua hàng từ shop của chúng tôi!</h1>
        <h2>Đơn hàng sẽ nhanh chóng được giao đến cho bạn.</h2>
        <h3>Bạn có thể kiểm tra thông tin và trạng thái trong "Đơn hàng của tôi".</h3>
        <a href="{{ route('order.index') }}" class="btn-check-orders">Kiểm tra đơn hàng của tôi</a>
    </div>
</div>

@endsection