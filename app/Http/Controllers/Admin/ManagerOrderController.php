<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ManagerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(4);
        return view('admin.order.managerorder')->with("orders", $orders);
    }

    public function destroy($id){
        $order = Order::findOrFail($id);
        $userName = $order->user->name ?? 'Không xác định'; 
        $order->delete();
        return redirect()->route('admin.order.managerorder')
        ->with('success', "Đơn hàng id $id của người dùng $userName đã được xóa thành công!");
    }

    public function edit($id){
        $order = Order::find($id);
       return view("admin.order.updateorder")->with("order",$order);
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,failed'
        ]);
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        return redirect()->route('admin.order.managerorder')->with('success', "Đơn hàng $id đã được cập nhật thành công!");
    }

    public function show($id){
    $order = Order::with('orderDetails.product')->find($id);
    if (!$order) {
        return redirect()->route('admin.order.managerorder')->with('error', 'Đơn hàng không tồn tại.');
    }
    if ($order->orderDetails->isEmpty()) {
        return redirect()->route('admin.order.managerorder')->with('error', 'Đơn hàng không có chi tiết.');
    }
    return view('admin.order.showorder', compact('order'));
    }

}
