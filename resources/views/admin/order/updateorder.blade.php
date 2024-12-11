@extends('layouts.admin.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="page-inner">
            <ol class="breadcrumb mb-4 bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/order">Orders</a></li>
                <li class="breadcrumb-item active">Update Category</li>
            </ol>
            <div class="form-container bg-white p-4 shadow rounded-lg">
                <h2 class="text-center mb-4">Cập Nhật Trạng Thái Đơn Hàng </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.order.managerorder.update', ['id' => $order->id]) }}" id="form-create"
                    method="POST" class="row g-4 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Tên Người Nhận</label>
                        <input disabled type="text" class="form-control" name="receiverName" id="validationCustom01"
                            placeholder="" required value="{{ $order->receiverName }}">
                        <div class="invalid-feedback">
                            Vui lòng nhập tên hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Địa Chỉ Người Nhận</label>
                        <input disabled type="text" class="form-control" name="receiverAddress" id="validationCustom02"
                            placeholder="" required value="{{ $order->receiverAddress }}">
                        <div class="invalid-feedback">
                            Vui lòng nhập tên hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="validationCustom04" name="status" required>
                            <option selected disabled value="">Vui lòng chọn</option>
                            <option {{ $order->status === 'pending' ? 'selected' : '' }} value="pending">Đang chờ xử lý
                            </option>
                            <option {{ $order->status === 'processing' ? 'selected' : '' }} value="processing ">Đang xử lý
                            </option>
                            <option {{ $order->status === 'shipped ' ? 'selected' : '' }} value="shipped ">Đang giao hàng
                            </option>
                            <option {{ $order->status === 'delivered ' ? 'selected' : '' }} value="delivered  ">Giao hàng
                                thành công</option>
                            <option {{ $order->status === 'cancelled ' ? 'selected' : '' }} value="cancelled ">Hủy đơn hàng
                            </option>
                            <option {{ $order->status === 'failed ' ? 'selected' : '' }} value="failed">Thất bại</option>
                        </select>
                        <div class="invalid-feedback">
                            Vui lòng chọn trạng thái hợp lệ.
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary py-2" type="submit">Cập nhật </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const form = document.getElementById('form-create');
        form.addEventListener('submit', function(event) {
            form.classList.add('was-validated');
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>

@endsection
