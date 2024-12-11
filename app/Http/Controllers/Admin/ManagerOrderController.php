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
}
