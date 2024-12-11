@extends('layouts.admin.dashboard')

@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.order.managerorder') }}">Orders</a></li>
                <li class="breadcrumb-item active">Order Details</li>
            </ol>
            <h3 class="mb-4">Chi Tiết Đơn Hàng #{{ $order->id }}</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Thông Tin Đơn Hàng</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Người Nhận: </strong> &nbsp;{{ $order->receiverName }}
                                </li>
                                <li class="list-group-item"><strong>Địa Chỉ: </strong>&nbsp; {{ $order->receiverAddress }}
                                </li>
                                <li class="list-group-item"><strong>Tổng Tiền:</strong>
                                    &nbsp; {{ number_format($order->totalPrice, 0, ',', '.') }} VNĐ</li>
                                <li class="list-group-item"><strong>Trạng Thái:</strong>&nbsp; {{ $order->status }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if ($order->orderDetails->isNotEmpty())
                <h4 class="mt-4 mb-4">Danh Sách Sản Phẩm</h4>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Tổng Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $key => $orderDetail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $orderDetail->product->name }}</td>
                                <td>{{ $orderDetail->quality }}</td>
                                <td>{{ number_format($orderDetail->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ number_format($orderDetail->quality * $orderDetail->price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Đơn hàng này không có sản phẩm.</p>
            @endif
        </div>
    </div>
@endsection
