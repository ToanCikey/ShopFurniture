function img(anything) {
    document.querySelector('.slide').src = anything;
}

function change(change) {
    const line = document.querySelector('.home');
    line.style.background = change;
}





document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const cartIcon = document.querySelector('.cart-icon');

    // Cập nhật số lượng trong biểu tượng giỏ hàng
    function updateCartIcon() {
        const totalItems = Object.values(cart).reduce((acc, qty) => acc + qty, 0);
        cartIcon.querySelector('.cart-count').textContent = totalItems > 0 ? totalItems : '';
    }

    // Thêm sản phẩm vào giỏ
    function addToCart(productId) {
        if (cart[productId]) {
            cart[productId] += 1; // Tăng số lượng nếu sản phẩm đã có trong giỏ
            alert('Sản phẩm này đã có trong giỏ hàng. Số lượng đã được tăng lên.');
        } else {
            cart[productId] = 1; // Thêm sản phẩm mới với số lượng 1
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartIcon(); // Cập nhật lại số lượng trong biểu tượng giỏ hàng
    }

    // Gắn sự kiện cho các nút "THÊM VÀO GIỎ"
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Ngăn không cho hành động mặc định
            const productId = button.closest('.col-md-3').querySelector('a').getAttribute('href').split('/').pop();
            addToCart(productId);
        });
    });

    updateCartIcon(); // Cập nhật icon khi tải trang
});
    // document.addEventListener('DOMContentLoaded', () => {
    //     const cartUrl = "{{ route('cart.index') }}"; // Lưu đường dẫn vào biến

    //     document.getElementById('cart-icon').addEventListener('click', (event) => {
    //         event.preventDefault();
    //         window.location.href = cartUrl; // Sử dụng biến để chuyển hướng
    //     });
    // });