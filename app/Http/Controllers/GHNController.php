<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class GHNController extends Controller
{
    private $token;
    private $shopId;

    public function __construct()
    {
        $this->token = env('GHN_API_KEY');
        $this->shopId = env('GHN_SHOP_ID');
    }
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'Token' => $this->token
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province');

        return response()->json($response->json());
    }


    public function getDistricts($province_id)
    {
        $response = Http::withHeaders([
            'Token' => $this->token
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district', [
            'province_id' => $province_id
        ]);

        return response()->json($response->json());
    }

    public function getWards($district_id)
    {
        $response = Http::withHeaders([
            'Token' => $this->token
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
            'district_id' => $district_id
        ]);

        return response()->json($response->json());
    }

    public function getAvailableServices(Request $request)
    {
        $response = Http::withHeaders([
            'Token' => $this->token
        ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services', [
            'shop_id' => (int) env('GHN_SHOP_ID'),
            "from_district" => (int) env('FROM_DISTRICT_ID'),
            "to_district" => (int) $request->to_district_id
        ]);

        return response()->json($response->json());
    }

    public function calculateShipping(Request $request)
    {
        if (!$request->to_district_id || !$request->to_ward_code) {
            return response()->json([
                'code' => 400,
                'message' => 'Thiếu thông tin quận/huyện hoặc phường/xã.',
                'data' => null
            ]);
        }
        $from_district_id = (int) env('FROM_DISTRICT_ID');
        $from_ward_code = env('FROM_WARD_CODE');

        $cart = session()->get('cart', []);

        $totalWeight = 0;
        $totalHeight = 0;
        $totalLength = 0;
        $totalWidth = 0;
        $items = [];

        foreach ($cart as $product) {
            $quantity = $product['quality'] ?? 1;

            $weight = $product['weight'] ?? 500;
            $height = $product['height'] ?? 10;
            $length = $product['length'] ?? 20;
            $width = $product['width'] ?? 15;


            $totalWeight += $weight * $quantity;
            $totalHeight += $height * $quantity;
            $totalLength += $length * $quantity;
            $totalWidth += $width * $quantity;


            $items[] = [
                "name" => $product['name'],
                "height" => $height,
                "weight" => $weight,
                "length" => $length,
                "width" => $width
            ];
        }
        // \Log::info('Dữ liệu items:', $items);

        $response = Http::withHeaders([
            'Token' => $this->token,
            'ShopId' => $this->shopId
        ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', [
            "from_district_id" => $from_district_id,
            "from_ward_code" => $from_ward_code,
            "service_id" => (int)$request->service_id,
            "to_district_id" => $request->to_district_id,
            "to_ward_code" => (string) $request->to_ward_code,
            "service_type_id" => $request->service_type_id ?? null,
            "coupon" => $request->coupon ?? null,
            "height" => $totalHeight,
            "length" => $totalLength,
            "weight" => $totalWeight,
            "width" => $totalWidth,
            "insurance_value" => $request->total ?? 0,
            "cod_failed_amount" => $request->cod_failed_amount ?? 0,
            "items" => $items
        ]);

        return response()->json($response->json());
    }

    public function createOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        $totalWeight = 0;
        $totalHeight = 0;
        $totalLength = 0;
        $totalWidth = 0;
        $items = [];

        foreach ($cart as $product) {
            $quantity = $product['quantity'] ?? 1;
            $weight = $product['weight'] ?? 500;
            $height = $product['height'] ?? 10;
            $length = $product['length'] ?? 20;
            $width = $product['width'] ?? 15;

            $totalWeight += $weight * $quantity;
            $totalHeight += $height * $quantity;
            $totalLength += $length * $quantity;
            $totalWidth += $width * $quantity;

            $items[] = [
                "name" => $product['name'],
                "height" => $height,
                "weight" => $weight,
                "length" => $length,
                "width" => $width,
                "quantity" => $quantity
            ];
        }

        $from_district_id = (int) env('FROM_DISTRICT_ID');
        $from_ward_code = env('FROM_WARD_CODE');

        $payload = [
            "payment_type_id" => 2,
            "note" => "Gọi trước khi giao hàng",
            "required_note" => "CHOXEMHANGKHONGTHU",
            "from_name" => "Shop Furniture",
            "from_phone" => "0987654321",
            "from_address" => "123 Tân Kỳ Tân Qúy, Phường Bình Hưng Hòa A, Quận Bình Tân, Hồ Chí Minh, Vietnam",
            "from_ward_name" => "Phường Bình Hưng Hòa A",
            "from_district_name" => "Quận Bình Tân",
            "from_province_name" => "HCM",
            "return_phone" => "0987654321",
            "return_address" => "123 Tân Kỳ Tân Qúy, Phường Bình Hưng Hòa A, Quận Bình Tân, Hồ Chí Minh, Vietnam",
            "return_district_id" => $from_district_id,
            "return_ward_code" => $from_ward_code,
            "client_order_code" => "",
            "to_name" => $request->receiver_name,
            "to_phone" => $request->receiver_phone,
            "to_address" => $request->receiver_address,
            "to_ward_code" => (string) $request->to_ward_code,
            "to_district_id" => $request->to_district_id,
            "cod_amount" => (int) $request->total_amount,
            "content" => "",
            "height" => $totalHeight,
            "length" => $totalLength,
            "weight" => $totalWeight,
            "width" => $totalWidth,
            "pick_station_id" => null,
            "deliver_station_id" => null,
            "insurance_value" => (int) min($request->total_amount, 5000000),
            "service_id" => (int)$request->service_id,
            "service_type_id" => 2,
            "coupon" => null,
            "pick_shift" => [1, 2],
            "items" => $items
        ];

        $response = Http::withHeaders([
            'Token' => $this->token,
            'shop_id' => $this->shopId
        ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', $payload);

        $responseData = $response->json();

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => $responseData['message'] ?? 'Lỗi không xác định từ GHN',
                'error_code' => $responseData['code'] ?? null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tạo đơn hàng thành công!',
            'data' => $responseData['data'] ?? null
        ]);
    }
    public function getOrderStatus($orderCode)
    {
        $response = Http::withHeaders([
            'Token' => $this->token
        ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/detail', [
            'order_code' => $orderCode
        ]);
        Log::info("Order Code to cancel:", [$orderCode]);
        $data = $response->json();

        if ($response->successful() && isset($data['data']['status'])) {
            return response()->json([
                'success' => true,
                'status' => $data['data']['status']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $data['message'] ?? 'Không lấy được trạng thái đơn hàng'
            ], 400);
        }
    }
    public function cancelOrder($orderCode)
    {
        $payload = [
            'order_codes' => [$orderCode]
        ];

        Log::info("Gửi request hủy đơn hàng GHN:", $payload);


        $response = Http::withHeaders([
            'Token' => $this->token,
            'ShopId' => $this->shopId,
            "Content-Type" => "application/json",
        ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/switch-status/cancel', [
            'order_codes' => [$orderCode]
        ]);
        $data = $response->json();
        Log::info("Phản hồi từ GHN:", $data);

        // Kiểm tra phản hồi từ GHN
        if ($response->successful() && isset($data['data']) && is_array($data['data']) && count($data['data']) > 0) {
            $orderResult = $data['data'][0] ?? null;

            if ($orderResult && isset($orderResult['result']) && $orderResult['result'] === true) {
                // Cập nhật trạng thái đơn hàng
                Order::where('orderCode', $orderCode)->update(['status' => 'cancel']);

                return response()->json([
                    'success' => true,
                    'message' => 'Đơn hàng đã được hủy thành công!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $orderResult['message'] ?? 'Không thể hủy đơn hàng (lỗi không rõ nguyên nhân)'
                ], 400);
            }
        }

        return response()->json([
            'success' => false,
            'message' => $data['message'] ?? 'Không thể hủy đơn hàng'
        ], 400);
    }
}
