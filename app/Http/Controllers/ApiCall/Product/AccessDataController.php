<?php

namespace App\Http\Controllers\ApiCall\Product;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\ClientsProducts;
use App\Models\License;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessDataController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function accessData(Request $request)
    {
        $client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $product_id = $request->header('product_id');

        $client = Clients::query()->where('client_id', $client_id)->first();

        $data = ClientsProducts::query()->where('product_id', $product_id)->where('client_id', $client->id)->get();
        $data['licenses_code'] = License::query()
            ->where('product_id', $product_id)
            ->where('client_id', $client->id)
            ->where('block', 0)
            ->where('date', '>=', Carbon::now()->format('Y:m:d'))
            ->get();

        if (count($data['licenses_code']) == 0 ) {
            $data['licenses_code'] = 'No Licenses Active For This Product';
        }

        return response()->json([
            'data' => $data,
            'message' => 'Data returned',
            'status' => 200,
        ]);
    }
}
