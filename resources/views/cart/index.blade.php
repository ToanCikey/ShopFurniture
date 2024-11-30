@extends('layouts.app')

@section('content')
<div class="container px-4 py-5 mx-auto" style="margin-top: 55px; width: 1320px;">
    <div class="row d-flex justify-content-center" style="width: 100%;">
        <div class="col-5">
            <h4 class="heading">Shopping Bag</h4>
        </div>
        <div class="col-7">
            <div class="row text-right">
                <div class="col-4">
                    <h6 class="mt-2">Format</h6>
                </div>
                <div class="col-4">
                    <h6 class="mt-2">Quantity</h6>
                </div>
                <div class="col-4">
                    <h6 class="mt-2">Price</h6>
                </div>
            </div>
        </div>
    </div>
    @php $total = 0 @endphp
    @if(session('cart'))
    @foreach(session('cart') as $id => $item)
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
                    <p class="mob-text">Digital</p>
                </div>
                <div class="col-4">
                    <div class="row d-flex justify-content-end px-3">
                        <div class="d-flex flex-column plus-minus">
                            <input type="number" value="{{$item['quality']}}">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <h6 class="mob-text">{{number_format($item['price'] * $item['quality'])}} VNĐ</h6>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-3 radio-group">
                        <div class="row d-flex px-3 radio">
                            <img class="pay" src="https://i.imgur.com/WIAP9Ku.jpg">
                            <p class="my-auto">Credit Card</p>
                        </div>
                        <div class="row d-flex px-3 radio gray">
                            <img class="pay" src="https://i.imgur.com/OdxcctP.jpg">
                            <p class="my-auto">Debit Card</p>
                        </div>
                        <div class="row d-flex px-3 radio gray mb-3">
                            <img class="pay" src="https://i.imgur.com/cMk1MtK.jpg">
                            <p class="my-auto">PayPal</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Name on Card</label>
                                <input type="text" id="cname" name="cname" placeholder="Johnny Doe">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Card Number</label>
                                <input type="text" id="cnum" name="cnum" placeholder="1111 2222 3333 4444">
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Expiration Date</label>
                                <input type="text" id="exp" name="exp" placeholder="MM/YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="***">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2">
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Subtotal</p>
                            <h6 class="mb-1 text-right">$23.49</h6>
                        </div>
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Shipping</p>
                            <h6 class="mb-1 text-right">$2.99</h6>
                        </div>
                        <div class="row d-flex justify-content-between px-4" id="tax">
                            <p class="mb-1 text-left">Total (tax included)</p>
                            <h6 class="mb-1 text-right">$26.48</h6>
                        </div>
                        <button class="btn-block btn-blue">
                            <span>
                                <span id="checkout">Checkout</span>
                                <span id="check-amt">$26.48</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
$(document).ready(function() {

    $('.radio-group .radio').click(function() {
        $('.radio').addClass('gray');
        $(this).removeClass('gray');
    });

    $('.plus-minus .plus').click(function() {
        var count = $(this).parent().prev().text();
        $(this).parent().prev().html(Number(count) + 1);
    });

    $('.plus-minus .minus').click(function() {
        var count = $(this).parent().prev().text();
        $(this).parent().prev().html(Number(count) - 1);
    });

});
</script>