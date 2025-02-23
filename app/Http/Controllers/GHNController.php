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

    public function calculateShipping(Request $request)
{
    // Kiểm tra dữ liệu bắt buộc
    if ( !$request->to_district_id || !$request->to_ward_code) {
        return response()->json([
            'code' => 400,
            'message' => 'Thiếu thông tin quận/huyện hoặc phường/xã.',
            'data' => null
        ]);
    }

    $shopId = env('GHN_SHOP_ID');
    $from_district_id = (int) env('fromDistrictId'); 
    $from_ward_code = env('fromWardCode'); 

    // Gửi request đến GHN API
    $response = Http::withHeaders([
        'Token' => $this->token,
        'ShopId' => $shopId
    ])->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', [
        "service_id" => 53320,
        "service_type_id" => $request->service_type_id ?? null,
        "insurance_value" => $request->insurance_value ?? 0,
        "coupon" => $request->coupon ?? null,
        "from_district_id" => $from_district_id,
        "from_ward_code" => $from_ward_code,
        "to_district_id" => $request->to_district_id,
        "to_ward_code" => $request->to_ward_code,
        "height" => $request->height ?? 50,
        "length" => $request->length ?? 20,
        "weight" => $request->weight ?? 200,
        "width" => $request->width ?? 20,
        "cod_failed_amount" => $request->cod_failed_amount ?? 2000,
        "items" => $request->items ?? [] 
    ]);

    return response()->json($response->json());
}

}
