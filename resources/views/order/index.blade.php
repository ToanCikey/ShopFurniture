@extends('layouts.app')
@section('title')
    Detail Order
@endsection
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

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .status.ready_to_pick {
            background: #ffecb3;
            color: #795548;
        }

        .status.picking {
            background: #fff59d;
            color: #ff8f00;
        }

        .status.delivering {
            background: #bbdefb;
            color: #1976d2;
        }

        .status.delivered {
            background: #c8e6c9;
            color: #388e3c;
        }

        .status.cancel {
            background: #ef9a9a;
            color: #c62828;
        }

        .status.return {
            background: #ffe0b2;
            color: #e65100;
        }

        .status.error {
            background: #f44336;
            color: white;
        }

        .btn-cancel {
            background: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .btn-cancel.active-cancel {
            cursor: pointer;
            opacity: 1;
        }
    </style>

    <div class="container">
        <h1>Danh Sách Đơn Hàng Của Bạn</h1>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID Đơn Hàng</th>
                    <th>Tên Người Nhận</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <!-- Giả sử bạn có một mảng đơn hàng -->
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->orderCode }}</td>
                        <td>{{ $order->receiverName }}</td>
                        <td>{{ number_format($order->totalPrice) }} VNĐ</td>
                        <!-- <td>{{ ucfirst($order->status) }}</td> -->
                        <td>
                            <button class="btn-status btn btn-success" data-order-code="{{ $order->orderCode }}">Xem trạng
                                thái</button>
                            <span id="status-{{ $order->orderCode }}"></span>
                            <button class="btn btn-cancel" data-order-code="{{ $order->orderCode }}">Hủy Đơn</button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-success col-xl-4">
            <a href="{{ route('index') }}" class="btn">Tiếp tục mua hàng</a>
        </button>

    </div>
@endsection
@push('script')
    <script>
        document.querySelectorAll(".btn-status").forEach(button => {
            button.addEventListener("click", function() {
                let orderCode = this.getAttribute("data-order-code");
                let statusSpan = document.getElementById("status-" + orderCode);

                console.log("Order Code:", orderCode);
                console.log("Status Element:", statusSpan);

                if (!statusSpan) {
                    alert(`Không tìm thấy phần tử có ID status-${orderCode}`);
                    return;
                }

                fetch(`/api/order-status/${orderCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let statusText = getStatusText(data.status);
                            statusSpan.innerHTML =
                                `<span class="status ${data.status}">${statusText}</span>`;
                        } else {
                            statusSpan.innerHTML =
                                `<span class="status error">Lỗi khi lấy trạng thái</span>`;
                        }
                    })
                    .catch(error => {
                        console.error("Lỗi khi gọi API trạng thái đơn hàng:", error);
                        statusSpan.innerHTML = `<span class="status error">Lỗi kết nối</span>`;
                    });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-cancel").forEach(button => {
                button.addEventListener("click", function() {
                    let orderCode = this.getAttribute("data-order-code");

                    if (!orderCode) {
                        alert("Lỗi: Không tìm thấy mã đơn hàng!");
                        return;
                    }

                    fetch(`/api/order-status/${orderCode}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let currentStatus = data.status;

                                if (currentStatus === "ready_to_pick") {
                                    if (!confirm(
                                            "Đơn hàng đang chờ lấy. Bạn có chắc chắn muốn hủy?"
                                        )) {
                                        return;
                                    }

                                    fetch(`/api/cancel-order/${orderCode}`, {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            },
                                            body: JSON.stringify({
                                                orderCode: orderCode
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert("Đơn hàng đã được hủy thành công!");
                                                location.reload();
                                            } else {
                                                alert("Không thể hủy đơn hàng: " + (data
                                                    .message || "Lỗi không xác định"
                                                ));
                                            }
                                        })
                                        .catch(error => {
                                            console.error("Lỗi khi hủy đơn hàng:", error);
                                            alert("Lỗi kết nối, vui lòng thử lại.");
                                        });

                                } else {
                                    alert("Không thể hủy đơn hàng vì trạng thái hiện tại là: " +
                                        getStatusText(currentStatus));
                                }
                            } else {
                                alert("Lỗi: Không lấy được trạng thái đơn hàng!");
                            }
                        })
                        .catch(error => {
                            console.error("Lỗi khi kiểm tra trạng thái đơn hàng:", error);
                            alert("Lỗi kết nối, vui lòng thử lại.");
                        });
                });
            });
        });


        function getStatusText(statusCode) {
            const statusMap = {
                'ready_to_pick': 'Chờ lấy hàng',
                'picking': 'Đang lấy hàng',
                'delivering': 'Đang giao hàng',
                'delivered': 'Đã giao hàng',
                'cancel': 'Đã hủy',
                'return': 'Hoàn hàng'
            };
            return statusMap[statusCode] || "Không xác định";
        }
    </script>
@endpush
