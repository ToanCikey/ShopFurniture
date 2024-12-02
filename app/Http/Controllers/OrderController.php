<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('order.index', compact('orders'));
    }
    public function success()
    {
        return view('order.success');
    }
    public function login() {}
    public function processCheckout(Request $request)
    {
        // Xác thực người dùng
        $userId = Auth::id();

        // Tạo đơn hàng
        $order = new Order();
        $order->totalPrice = $request->input('totalPrice'); // Tổng tiền
        $order->ReceiverName = $request->input('receiverName');
        $order->ReceiverAddress = $request->input('receiverAddress');
        $order->status = 'pending'; // Trạng thái đơn hàng
        $order->user_id = $userId;
        $order->save();

        // Lưu chi tiết đơn hàng
        foreach (session('cart') as $id => $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->quality = $item['quality'];
            $orderDetail->price = $item['price'];
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $id;
            $orderDetail->save();
        }

        // Lưu thông tin thanh toán
        $payment = new Payment();
        $payment->status = 'completed'; // Trạng thái thanh toán
        $payment->transactionDate = now();
        $payment->amount = $request->input('totalPrice');
        $payment->payment_method = $request->input('paymentMethod');
        $payment->order_id = $order->id;
        $payment->save();

        // Xóa giỏ hàng
        session()->forget('cart');

        // Chuyển hướng đến trang đơn hàng
        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }
}
