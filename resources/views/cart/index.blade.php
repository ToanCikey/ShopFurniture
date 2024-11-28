@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Giỏ Hàng</h3>
    <div id="cart-items"></div>
    <button id="checkout-btn">Thanh Toán</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        const cartItemsDiv = document.getElementById('cart-items');

        // Hiển thị các sản phẩm trong giỏ hàng
        for (const productId in cart) {
            // Gọi API để lấy thông tin sản phẩm
            fetch(`/products/${productId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(product => {
                    cartItemsDiv.innerHTML += `
                        <div>
                            <h4>${product.name}</h4>
                            <p>Giá: ${product.price} VND</p>
                            <p>Số lượng: ${cart[productId]}</p>
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }

        // Thêm sự kiện cho nút thanh toán
        document.getElementById('checkout-btn').addEventListener('click', () => {
            alert('Chức năng thanh toán chưa được triển khai.');
        });
    });
</script>
@endsection