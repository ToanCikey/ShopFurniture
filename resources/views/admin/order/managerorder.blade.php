@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th width="5%" scope="col">STT</th>
                        <th width="15%" scope="col">ReceiverName</th>
                        <th width="30%" scope="col">ReceiverAddress</th>
                        <th width="15%" scope="col">TotalPrice</th>
                        <th width="5%" scope="col">Status</th>
                        <th width="30%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->receiverName }}</td>
                            <td>{{ $order->receiverAddress }}</td>
                            <td>{{ number_format($order->totalPrice, 0, ',', '.') }} VNĐ</td>
                            <td>{{ $order->status }}</td>
                            <td class="d-flex" style="gap: 10px">
                                <a href="{{ route('admin.order.managerorder.edit', $order->id) }}"
                                    class="btn btn-warning">Update</a>
                                <a href="{{ route('admin.order.managerorder.show', $order->id) }}" class="btn btn-info">
                                    Chi Tiết</a>
                                <form action="{{ route('admin.order.managerorder.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
