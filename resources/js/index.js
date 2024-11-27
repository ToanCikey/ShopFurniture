function img(anything) {
    document.querySelector('.slide').src = anything;
}

function change(change) {
    const line = document.querySelector('.home');
    line.style.background = change;
}



// document.addEventListener('DOMContentLoaded', () => {
//         const cart = JSON.parse(localStorage.getItem('cart')) || {};
//         const cartIcon = document.querySelector('.cart-icon');

//         // Cập nhật số lượng trong biểu tượng giỏ hàng
//         function updateCartIcon() {
//             const totalItems = Object.values(cart).reduce((acc, qty) => acc + qty, 0);
//             cartIcon.querySelector('.cart-count').textContent = totalItems > 0 ? totalItems : '';
//         }
//         function renderCartItems() {
//             const cartItemsContainer = document.querySelector('.cart-items');
//             cartItemsContainer.innerHTML = ''; // Xóa nội dung cũ
//             for (const productId in cart) {
//                 const product =  products.find(p => p.id == productId);// Lấy sản phẩm từ mảng sản phẩm của bạn bằng productId
//                 if(product) {
//                     const itemHTML = `
//                         <div class="cart-item d-flex align-items-center py-2">
//                             <img src="${product.productImages[0].imageURL}" alt="${product.name}" width="50px" class="me-2">
//                             <div>
//                                 <h5>${product.name}</h5>
//                                 <p>${product.price} VND</p>
//                                 <p>Số lượng: ${cart[productId]}</p>
//                             </div>
//                         </div>
//                     `;
//                     cartItemsContainer.innerHTML += itemHTML;
//                 }
//             }
//         }

//         // Thêm sản phẩm vào giỏ
//         function addToCart(productId) {
//             if (cart[productId]) {
//                 alert('Sản phẩm này đã có trong giỏ hàng.');
//             } else {
//                 cart[productId] = 1; // Thêm sản phẩm với số lượng 1
//             }
//             localStorage.setItem('cart', JSON.stringify(cart));
//             updateCartIcon();
//             renderCartItems(); // Gọi hàm để render giỏ hàng
//         }

//         // Gắn sự kiện cho các nút "THÊM VÀO GIỎ"
//         document.querySelectorAll('.add-to-cart').forEach(button => {
//             button.addEventListener('click', (event) => {
//                 event.preventDefault(); // Ngăn không cho hành động mặc định
//                 const productId = button.closest('.col-md-3').querySelector('a').getAttribute('href').split('/').pop();
//                 addToCart(productId);
//             });
//         });
//         cartIcon.addEventListener('mouseenter', renderCartItems);
//         updateCartIcon(); // Cập nhật icon khi tải trang
// });
// document.addEventListener('DOMContentLoaded', () => {
//     const cart = JSON.parse(localStorage.getItem('cart')) || {};
//     const cartIcon = document.querySelector('.cart-icon');
//     const products = []; // Danh sách sản phẩm sẽ được load từ server hoặc API.

//     // Hàm cập nhật số lượng sản phẩm trên biểu tượng giỏ hàng
//     function updateCartIcon() {
//         const totalItems = Object.values(cart).reduce((acc, qty) => acc + qty, 0);
//         cartIcon.querySelector('.cart-count').textContent = totalItems > 0 ? totalItems : '';
//     }

//     // Hàm hiển thị sản phẩm đã thêm trong giỏ hàng
//     function renderCartItems() {
//         const cartItemsContainer = document.querySelector('.cart-items');
//         cartItemsContainer.innerHTML = ''; // Xóa nội dung cũ

//         for (const productId in cart) {
//             const product = products.find(p => p.id == productId); // Lấy sản phẩm từ danh sách
//             if (product) {
//                 const itemHTML = `
//                     <div class="cart-item d-flex align-items-center py-2">
//                         <img src="${product.productImages[0]?.imageURL}" alt="${product.name}" width="50px" class="me-2">
//                         <div>
//                             <h5>${product.name}</h5>
//                             <p>${product.price.toLocaleString()} VND</p>
//                             <p>Số lượng: ${cart[productId]}</p>
//                         </div>
//                     </div>
//                 `;
//                 cartItemsContainer.innerHTML += itemHTML;
//             }
//         }
//     }

//     // Hàm thêm sản phẩm vào giỏ hàng
//     function addToCart(productId) {
//         if (cart[productId]) {
//             cart[productId]++; // Tăng số lượng nếu sản phẩm đã tồn tại
//         } else {
//             cart[productId] = 1; // Thêm sản phẩm với số lượng 1
//         }
//         localStorage.setItem('cart', JSON.stringify(cart));
//         updateCartIcon();
//         renderCartItems(); // Render lại danh sách sản phẩm trong giỏ
//     }

//     // Gắn sự kiện cho các nút "THÊM VÀO GIỎ"
//     document.querySelectorAll('.add-to-cart').forEach(button => {
//         button.addEventListener('click', (event) => {
//             event.preventDefault(); // Ngăn không cho hành động mặc định
//             const productId = button.closest('.col-md-3').dataset.productId; // Lấy ID sản phẩm từ data attribute
//             addToCart(productId);
//         });
//     });

//     // Gọi hàm render khi hover vào icon giỏ hàng
//     cartIcon.addEventListener('mouseenter', renderCartItems);

//     // Cập nhật icon khi tải trang
//     updateCartIcon();
// });
// document.addEventListener('DOMContentLoaded', function () {
//     const cartIcon = document.querySelector('.cart-icon');
//     const cartDropdown = document.querySelector('.cart-dropdown');

//     cartIcon.addEventListener('mouseenter', function () {
//         cartDropdown.style.display = 'block';
//     });

//     cartIcon.addEventListener('mouseleave', function () {
//         cartDropdown.style.display = 'none';
//     });
// });


// document.addEventListener('DOMContentLoaded', () => {
//     const cart = JSON.parse(localStorage.getItem('cart')) || {};
//     const cartIcon = document.querySelector('.cart-icon');
//     // Hàm cập nhật số lượng sản phẩm trên biểu tượng giỏ hàng
//     function updateCartIcon() {
//         const totalItems = Object.values(cart).reduce((acc, qty) => acc + qty, 0);
//         cartIcon.querySelector('.cart-count').textContent = totalItems > 0 ? totalItems : '';
//     }

//     // Hàm thêm sản phẩm vào giỏ hành
//     function addToCart(productId) {
//         if (cart[productId]) {
//            //alert("San pham da ton tai cut")
//         } else {
//             cart[productId] = 1; // Thêm sản phẩm với số lượng 1
//         }
//         localStorage.setItem('cart', JSON.stringify(cart));
//         updateCartIcon();
//         renderCartItems(); // Render lại danh sách sản phẩm trong giỏ
//     }

//     // Gắn sự kiện cho các nút "THÊM VÀO GIỎ"
//     document.querySelectorAll('.add-to-cart').forEach(button => {
//         button.addEventListener('click', (event) => {
//             event.preventDefault(); // Ngăn không cho hành động mặc định
//             const productId = button.closest('.col-md-3').dataset.productId; // Lấy ID sản phẩm từ data attribute
//             addToCart(productId);
//         });
//     });

   
//     // Cập nhật icon khi tải trang
//     updateCartIcon();
// });

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
                alert('Sản phẩm này đã có trong giỏ hàng.');
            } else {
                cart[productId] = 1; // Thêm sản phẩm với số lượng 1
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartIcon();
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