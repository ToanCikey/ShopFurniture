@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')
    <div class="container px-4 py-5 mx-auto" style="margin-top: 55px; width: 1320px;">
        <div class="row d-flex justify-content-center" style="width: 100%;">
            <div class="col-5">
                <h4 class="heading">Sản Phẩm</h4>
            </div>
            <div class="col-7">
                <div class="row text-right">
                    <div class="col-4">
                        <h6 class="mt-2">Vật liệu</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="mt-2">Số Lượng</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="mt-2">Giá</h6>
                    </div>
                </div>
            </div>
        </div>
        @php $total = 0 @endphp
        @if (session('cart'))
            @foreach (session('cart') as $id => $item)
                @php
                    $total += $item['price'] * $item['quality'];
                @endphp
                <div class="row d-flex justify-content-center border-top" style="width: 100%;">
                    <div class="col-5">
                        <div class="row d-flex">
                            <div class="book">
                                @if (isset($item['image']))
                                    <img src="{{ 'assets/image/product_image/' . $item['image'] }}" class="book-img">
                                @else
                                    <img src="/assets/image/card4.png" class="book-img">
                                @endif
                            </div>
                            <div class="my-auto flex-column d-flex pad-left">
                                <h6 class="mob-text">{{ $item['name'] }}</h6>
                                <p class="mob-text">{{ $item['brand'] ?? ' ' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="my-auto col-7">
                        <div class="row text-right">
                            <div class="col-4">
                                <p class="mob-text">{{ $item['material'] }}</p>
                            </div>
                            <div class="col-4">
                                <div class="row d-flex justify-content-end px-3">
                                    <div class="d-flex flex-column plus-minus">
                                        <input type="number" class="quality" data-product="{{ $item['id'] }}"
                                            value="{{ $item['quality'] }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-4" style="display: flex; justify-content: space-between; cursor: pointer;">
                                <h6 class="mob-text">{{ number_format($item['price'] * $item['quality']) }} VNĐ</h6>
                                <i class="fa-solid fa-trash delete-item" data-product-id="{{ $item['id'] }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card" style="min-width: 1200px;">
                    <div class="row">
                        <div class="col-lg-12" style="padding: 30px;">
                            <h5>Thông Tin Người Nhận</h5>
                            <form id="checkout-form" action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="receiverName">Tên Người Nhận</label>
                                    <input type="text" id="receiverName" name="receiverName" class="form-control"
                                        placeholder="Nhập tên người nhận" required>
                                </div>
                                <div class="form-group">
                                    <label for="receiverAddress">Địa Chỉ Cụ Thể</label>
                                    <input type="text" id="receiverAddress" name="receiverAddress" class="form-control"
                                        placeholder="Nhập địa chỉ cụ thể" required>
                                </div>
                                <div class="form-group">
                                    <label for="receiverPhone">Số Điện Thoại</label>
                                    <input type="tel" id="receiverPhone" name="receiverPhone" class="form-control"
                                        placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <label for="province">Tỉnh / Thành phố</label>
                                    <select id="province" name="province" class="form-control" required>
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        <!-- Dữ liệu tỉnh/thành phố sẽ được load bằng JavaScript -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="district">Quận / Huyện</label>
                                    <select id="district" name="district" class="form-control" required>
                                        <option value="">Chọn quận/huyện</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ward">Phường / Xã</label>
                                    <select id="ward" name="ward" class="form-control" required>
                                        <option value="">Chọn phường/xã</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="service_id">Dịch vụ vận chuyển</label>
                                    <select id="service_id" name="service_id" class="form-control" required>
                                        <option value="">Chọn dịch vụ</option>
                                    </select>
                                </div>
                                <input type="hidden" name="totalPrice" value="{{ $total }}">
                                <div style="display: flex; justify-content: space-between;">

                                    <div class="col-lg-5">
                                        <h5>Phương Thức Thanh Toán</h5>
                                        <div class="row px-2">
                                            <div class="form-check"
                                                style="display: flex; align-items: center; margin: 10px 0;">
                                                <input type="radio" class="form-check-input" id="momoRadio"
                                                    name="paymentMethod" value="momo" required
                                                    style="margin-right: 10px;">
                                                <label class="form-check-label" for="momoRadio"
                                                    style="display: flex; align-items: center; cursor: pointer;">
                                                    <img src="assets/image/momo.jpg" alt="MOMO"
                                                        style="width: 40px; height: 40px; margin-right: 10px; border-radius: 5px; border: 1px solid #ccc;">
                                                </label>
                                            </div>

                                        </div>

                                        <div class="row px-2">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="codRadio"
                                                    name="paymentMethod" value="cod">
                                                <label class="form-check-label" for="codRadio"
                                                    style="margin-left: 15px;">Thanh toán khi nhận
                                                    hàng</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mt-2">
                                        <div class="row d-flex justify-content-between px-4">
                                            <p class="mb-1 text-left">Tổng tiền</p>
                                            <h6 class="mb-1 text-right">{{ number_format($total) }} VNĐ</h6>
                                        </div>
                                        <div class="row d-flex justify-content-between px-4">
                                            <p class="mb-1 text-left">Shipping</p>
                                            <h6 class="mb-1 text-right" id="shippingFee">Đang tính...</h6>
                                        </div>
                                        <div class="row d-flex justify-content-between px-4" id="tax">
                                            <p class="mb-1 text-left">Tổng tiền</p>
                                            <h6 name="total" class="mb-1 text-right">{{ number_format($total) }} VNĐ
                                            </h6>
                                        </div>

                                        <button type="button" style="margin-left: 22px;" class="btn-block btn-blue"
                                            onclick="createOrder()">
                                            <span>
                                                <span id="checkout">Thanh Toán</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const deleteCart = document.querySelectorAll('.delete-item');
        deleteCart.forEach(deletes => {
            deletes.addEventListener('click', () => {
                axios.delete("{{ route('delete-product-cart') }}", {
                        params: {
                            id: deletes.dataset.productId
                        }
                    })
                    .then(res => {
                        window.location.reload();
                    })
            });
        });
        const inputQuality = document.querySelectorAll('.quality');
        inputQuality.forEach(inp => {
            inp.addEventListener('change', (e) => {
                const newQuality = e.target.value;
                if (newQuality < 1) { // Kiểm tra số lượng phải lớn hơn hoặc bằng 1
                    alert('Số lượng phải lớn hơn 0');
                    return; // Không thực hiện yêu cầu nếu số lượng không hợp lệ
                }

                axios.post("{{ route('update-product-cart') }}", {
                        product_id: inp.dataset.product,
                        quality: newQuality
                    })
                    .then(res => {
                        window.location.reload(); // Tải lại trang để cập nhật giỏ hàng
                    })
                    .catch(error => {
                        console.error('Có lỗi xảy ra:', error);
                    });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadProvinces();

            document.getElementById("province").addEventListener("change", function() {
                let provinceId = this.value;
                loadDistricts(provinceId);
            });

            document.getElementById("district").addEventListener("change", function() {
                let districtId = this.value;
                loadWards(districtId);
                getServiceId();
            });
            document.getElementById("service_id").addEventListener("change", function() {
                calculateShippingFee();
            });
            document.getElementById("ward").addEventListener("change", function() {
                calculateShippingFee();
            });
            document.addEventListener("DOMContentLoaded", function() {
                const checkoutForm = document.querySelector("#checkout-form"); // Định danh form
                if (checkoutForm) {
                    checkoutForm.addEventListener("submit", function(event) {
                        event.preventDefault(); // Ngăn form gửi dữ liệu ngay lập tức
                        createOrder();
                    });
                }
            });


        });

        function loadProvinces() {
            fetch("/provinces")
                .then(response => response.json())
                .then(data => {
                    console.log("Dữ liệu API:", data);

                    let provinceSelect = document.getElementById("province");
                    provinceSelect.innerHTML = '<option value="">Chọn tỉnh/thành phố</option>';

                    if (data && data.data && Array.isArray(data.data)) {
                        data.data.forEach(province => {
                            let option = document.createElement("option");
                            option.value = province.ProvinceID;
                            option.text = province.ProvinceName;
                            provinceSelect.appendChild(option);
                        });
                    } else {
                        console.error("Dữ liệu tỉnh/thành phố bị lỗi:", data);
                    }
                })
                .catch(error => console.error("Lỗi khi load tỉnh/thành phố:", error));
        }


        function loadDistricts(provinceId) {
            if (!provinceId) {
                console.error("Không có provinceId");
                return;
            }

            fetch(`/districts/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Dữ liệu quận/huyện:", data);

                    let districtSelect = document.getElementById("district");
                    districtSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';

                    if (data && data.data && Array.isArray(data.data)) {
                        data.data.forEach(district => {
                            let option = document.createElement("option");
                            option.value = district.DistrictID;
                            option.text = district.DistrictName;
                            districtSelect.appendChild(option);
                        });
                    } else {
                        console.error("Dữ liệu quận/huyện bị lỗi:", data);
                    }
                })
                .catch(error => console.error("Lỗi khi load quận/huyện:", error));
        }


        function loadWards(districtId) {
            if (!districtId) {
                console.error("Không có districtId");
                return;
            }

            fetch(`/wards/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Dữ liệu phường/xã:", data);

                    let wardSelect = document.getElementById("ward");
                    wardSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

                    if (data && data.data && Array.isArray(data.data)) {
                        data.data.forEach(ward => {
                            let option = document.createElement("option");
                            option.value = ward.WardCode;
                            option.text = ward.WardName;
                            wardSelect.appendChild(option);
                        });
                    } else {
                        console.error("Dữ liệu phường/xã bị lỗi:", data);
                    }
                })
                .catch(error => console.error("Lỗi khi load phường/xã:", error));
        }

        function getServiceId() {
            let toDistrictId = parseInt(document.getElementById("district").value);
            console.log("toDistrictId", toDistrictId);
            fetch('/serviceid', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        to_district_id: toDistrictId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Dữ liệu dịch vụ vận chuyển:", data); // Kiểm tra dữ liệu trả về
                    let serviceSelect = document.getElementById("service_id");
                    serviceSelect.innerHTML = "";

                    if (data.data) {
                        data.data.forEach(service => {
                            let option = document.createElement("option");
                            option.value = service.service_id;
                            option.textContent = service.short_name;
                            serviceSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error("Lỗi lấy dịch vụ:", error));

        };


        const productTotal = <?php echo json_encode($total); ?>;

        function calculateShippingFee() {
            let toDistrictId = parseInt(document.getElementById("district").value);
            let toWardCode = document.getElementById("ward").value;
            let serviceId = document.getElementById("service_id").value;

            if (!toDistrictId || !toWardCode || !serviceId) {
                alert("Vui lòng chọn đầy đủ thông tin vận chuyển trước khi tính phí.");
                return;
            }

            fetch("/calculate-shipping", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        service_id: serviceId,
                        to_district_id: toDistrictId,
                        to_ward_code: toWardCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === 200 && data.data) {
                        const shippingFee = data.data.total;
                        document.getElementById("shippingFee").textContent = shippingFee.toLocaleString('vi-VN') +
                            " VNĐ";
                        const finalTotal = productTotal + shippingFee;
                        document.querySelector('[name="total"]').textContent = finalTotal.toLocaleString('vi-VN') +
                            " VNĐ";
                    } else {
                        alert("Không thể lấy thông tin phí vận chuyển. Vui lòng thử lại!");
                    }
                })
                .catch(error => console.error("Lỗi khi tính phí vận chuyển:", error));
        }

        function createOrder() {
            let toDistrictId = parseInt(document.getElementById("district").value);
            let toWardCode = document.getElementById("ward").value;
            let serviceId = parseInt(document.getElementById("service_id").value);
            let receiverName = document.getElementById("receiverName").value;
            let receiverPhone = document.getElementById("receiverPhone").value;
            let receiverAddress = document.getElementById("receiverAddress").value;
            let totalText = document.querySelector('h6[name="total"]').innerText;
            let totalValue = totalText.replace(/\D/g, '');
            console.log(totalValue);

            if (!toDistrictId || !toWardCode || !serviceId || !receiverName || !receiverPhone || !receiverAddress) {
                alert("Vui lòng nhập đầy đủ thông tin trước khi đặt hàng!");
                return;
            }

            let requestData = {
                receiver_name: receiverName,
                receiver_phone: receiverPhone,
                receiver_address: receiverAddress,
                to_district_id: toDistrictId,
                to_ward_code: toWardCode,
                service_id: serviceId,
                total_amount: totalValue
            };

            console.log("Dữ liệu gửi lên API:", requestData); // Debug dữ liệu gửi đi

            fetch("/create_order", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => {
                    console.log("Trạng thái response:", response.status);
                    return response.json();
                })
                .then(data => {
                    console.log("Dữ liệu trả về từ API:", data);
                    if (data.success) {
                        localStorage.setItem('order_code', data.data.order_code);
                        alert("Đặt hàng thành công!");
                        window.location.href = "/orderAlter";
                    } else {
                        console.log("Dữ liệu trả về từ API:", data);
                        alert("Có lỗi xảy ra: " + (data.message || "Lỗi không xác định"));
                    }
                })
                .catch(error => {
                    console.error("Lỗi khi gọi API:", error);
                });
        }
    </script>
@endpush
