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
        if ($request->input('paymentMethod') === 'momo') {
            return $this->momo_payment($request); // Đảm bảo phương thức này hoạt động như mong muốn
        } else {
            return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
        }
        // Chuyển hướng đến trang đơn hàng
        //     return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo_payment(Request $request)
    {
        // $totalPrice = $request->input('total_momo');
        // Định nghĩa endpoint của MOMO
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        // Lấy thông tin từ cấu hình
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->input('totalPrice');
        $orderId = time() . "";
        $returnUrl = "http://localhost:8000/atm/result_atm.php";
        $notifyUrl = "http://localhost:8000/atm/ipn_momo.php"; // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";

        // Kiểm tra dữ liệu POST

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";

        // Tạo hash cho chữ ký HMAC SHA256
        $rawHashArr = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'bankCode' => $bankCode,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType
        ];

        $rawHash = "partnerCode=" . $partnerCode .
            "&accessKey=" . $accessKey .
            "&requestId=" . $requestId .
            "&bankCode=" . $bankCode .
            "&amount=" . $amount .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&returnUrl=" . $returnUrl .
            "&notifyUrl=" . $notifyUrl .
            "&extraData=" . $extraData .
            "&requestType=" . $requestType;

        // Tạo chữ ký
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Tạo dữ liệu để gửi đi
        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        // Gửi yêu cầu đến endpoint
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // Giải mã JSON

        // if (isset($jsonResult['payUrl'])) {
        //     return redirect($jsonResult['payUrl']);
        // } else {
        //     return redirect()->route('order.success')->withErrors(['message' => 'Lỗi khi tạo yêu cầu thanh toán MOMO.']);
        // }

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']); // Chuyển hướng đến trang thanh toán của MOMO
        } else {
            return redirect()->route('order.success')->withErrors(['message' => 'Lỗi khi tạo yêu cầu thanh toán MOMO.']);
        }
    }
}
