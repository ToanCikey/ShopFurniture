@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>Shopping Cart</h2>
    <div class="cart-items-container">
        <p class="text-center">Giỏ hàng trống</p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItemsContainer = document.querySelector('.cart-items-container');

        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function displayCart() {
            const cart = getCart();
            cartItemsContainer.innerHTML = ''; // Xóa các sản phẩm cũ

            if (cart.length > 0) {
                cart.forEach(item => {
                    cartItemsContainer.innerHTML += `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        <span>${item.name} (${item.quantity})</span>
                        <span>${(item.quantity * item.price).toLocaleString()} VND</span>
                    </div>
                `;
                });
            } else {
                cartItemsContainer.innerHTML = '<p class="text-center">Giỏ hàng trống</p>';
            }
        }

        displayCart();
    });
</script>
@endsection