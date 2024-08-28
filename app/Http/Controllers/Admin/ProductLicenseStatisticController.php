<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\LicensesUse;
use App\Models\ProductLicenseStatistic;
use App\Services\License\ProductStatistic;

class ProductLicenseStatisticController extends Controller
{
    public  function  index($license_id){
        $license = License::with('product')->findOrFail($license_id);
        $license_uses = LicensesUse::where('license_id',$license_id)->first();
        $response = new ProductStatistic('https://policytest.cyberx.world/api/statistics','RRib6O2gmZEbelOJJjQk0USZP');
        $data =$response->fetchData();
        $data['license_ip'] = $license_uses?$license_uses->ip:\Request::ip();
        $data['license_port'] = $license_uses?$license_uses->port:'' ;
        $data['end_point'] = $license->product?$license->product->statistic_end_point:'api/statistic';
         ProductLicenseStatistic::create([
           'product_id'=>$license->product_id,
           'client_id'=>$license->client_id,
           'data'=>json_encode($data),
           'license_id'=>$license->id
        ]);
        dd($data);
    }
}
