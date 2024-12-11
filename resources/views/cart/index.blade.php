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
    @if(session('cart'))
    @foreach(session('cart') as $id => $item)
    @php
    $total += $item['price'] * $item['quality'];
    @endphp
    <div class="row d-flex justify-content-center border-top" style="width: 100%;">
        <div class="col-5">
            <div class="row d-flex">
                <div class="book">
                    @if(isset($item['image']))
                    <img src="{{$item['image']}}" class="book-img">
                    @else
                    <img src="/assets/image/card4.png" class="book-img">
                    @endif
                </div>
                <div class="my-auto flex-column d-flex pad-left">
                    <h6 class="mob-text">{{$item['name']}}</h6>
                    <p class="mob-text">{{$item['brand'] ?? ' '}}</p>
                </div>
            </div>
        </div>
        <div class="my-auto col-7">
            <div class="row text-right">
                <div class="col-4">
                    <p class="mob-text">{{$item['material']}}</p>
                </div>
                <div class="col-4">
                    <div class="row d-flex justify-content-end px-3">
                        <div class="d-flex flex-column plus-minus">
                            <input type="number" class="quality" data-product="{{$item['id']}}"
                                value="{{$item['quality']}}">
                        </div>
                    </div>
                </div>
                <div class="col-4" style="display: flex; justify-content: space-between;">
                    <h6 class="mob-text">{{number_format($item['price'] * $item['quality'])}} VNĐ</h6>
                    <i class="fa-solid fa-trash delete-item" data-product-id="{{$item['id']}}"></i>
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
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="receiverName">Tên Người Nhận</label>
                                <input type="text" id="receiverName" name="receiverName" class="form-control"
                                    placeholder="Nhập tên người nhận" required>
                            </div>
                            <div class="form-group">
                                <label for="receiverAddress">Địa Chỉ Nhận Hàng</label>
                                <input type="text" id="receiverAddress" name="receiverAddress" class="form-control"
                                    placeholder="Nhập địa chỉ nhận hàng" required>
                            </div>
                            <div class="form-group">
                                <label for="receiverPhone">Số Điện Thoại</label>
                                <input type="tel" id="receiverPhone" name="receiverPhone" class="form-control"
                                    placeholder="Nhập số điện thoại" required>
                            </div>
                            <input type="hidden" name="totalPrice" value="{{ $total }}">
                            <div style="display: flex; justify-content: space-between;">

                                <div class="col-lg-5">
                                    <h5>Phương Thức Thanh Toán</h5>
                                    <div class="row px-2">
                                        <div class="form-check"
                                            style="display: flex; align-items: center; margin: 10px 0;">
                                            <input type="radio" class="form-check-input" id="momoRadio"
                                                name="paymentMethod" value="momo" required style="margin-right: 10px;">
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
                                        <h6 class="mb-1 text-right">Miễn Phí</h6>
                                    </div>
                                    <div class="row d-flex justify-content-between px-4" id="tax">
                                        <p class="mb-1 text-left">Tổng tiền</p>
                                        <h6 class="mb-1 text-right">{{ number_format($total) }} VNĐ</h6>
                                    </div>
                                    <button type="submit" name="redirect" class="btn-block btn-blue">
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
        axios.delete("{{route('delete-product-cart')}}", {
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
        axios.post("{{ route('update-product-cart')}}", {
                product_id: inp.dataset.product,
                quality: e.target.value
            })
            .then(res => {
                window.location.reload();
            });
    });
});
</script>
@endpush