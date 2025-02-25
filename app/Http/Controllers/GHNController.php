<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GHNController extends Controller
{
    private $token;

    public function __construct()
    {
        $this->token = env('GHN_API_KEY'); 
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
    // Kiểm tra dữ liệu bắt buộc
    if (!$request->to_district_id || !$request->to_ward_code) {
        return response()->json([
            'code' => 400,
            'message' => 'Thiếu thông tin quận/huyện hoặc phường/xã.',
            'data' => null
        ]);
    }

    $shopId = env('GHN_SHOP_ID');
    $from_district_id = (int) env('FROM_DISTRICT_ID'); 
    $from_ward_code = env('FROM_WARD_CODE'); 

    // Dữ liệu cố định cho items
    $items = [
        [
            "name" => "TEST1",
            "quantity" => 1,
            "height" => 200,
            "weight" => 1000,
            "length" => 200,
            "width" => 200
        ]
    ];

    // Gửi request đến GHN API
    $response = Http::withHeaders([
        'Token' => $this->token,
        'ShopId' => $shopId
    ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', [
        "from_district_id" => $from_district_id,
        "from_ward_code" => $from_ward_code,
        "service_id" => (int)$request->service_id,
        "to_district_id" => $request->to_district_id,
        "to_ward_code" => (string) $request->to_ward_code,
        "service_type_id" => $request->service_type_id ?? null,
        "coupon" => $request->coupon ?? null,
        "height" => $request->height ?? 20,
        "length" => $request->length ?? 20,
        "weight" => $request->weight ?? 1000,
        "width" => $request->width ?? 20,
        "insurance_value" => $request->total ?? 0,
        "cod_failed_amount" => $request->cod_failed_amount ?? 0,
        "items" => $items 
    ]);

    return response()->json($response->json());
}


}
