@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 100px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .status-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 10px;
        background: #e1f5fe;
        border-radius: 5px;
    }

    .status {
        flex: 1;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        margin: 0 5px;
        font-weight: bold;
    }

    .pending {
        background: #ffecb3;
        color: #795548;
    }

    .completed {
        background: #c8e6c9;
        color: #388e3c;
    }

    .canceled {
        background: #ef9a9a;
        color: #c62828;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #2196F3;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 10px;
        background: #2196F3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        margin-top: 20px;
    }

    .btn:hover {
        background: #1976D2;
    }
</style>

<div class="container">
    <h1>Danh Sách Đơn Hàng Của Bạn</h1>

    <table>
        <thead>
            <tr>
                <th>ID Đơn Hàng</th>
                <th>Tên Người Nhận</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            <!-- Giả sử bạn có một mảng đơn hàng -->
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->receiverName }}</td>
                <td>{{ number_format($order->totalPrice) }} VNĐ</td>
                <td>{{ ucfirst($order->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('index') }}" class="btn">Tiếp tục mua hàng</a>
</div>
@endsection