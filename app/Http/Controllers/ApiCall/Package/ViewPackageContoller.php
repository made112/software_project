<?php

namespace App\Http\Controllers\ApiCall\Package;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\Clients;
use App\Models\ProductPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use DB;
use App\Models\Versions;
use App\Models\ClientsProducts;
use App\Models\License;

class ViewPackageContoller  extends Controller
{

    protected $model;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    public function ViewPackage(Request $request)
    {
        $client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $product_id = $request->get('product_id');
        $domain = \Request::root();
        $ip = \Request::ip();
        $status = true;
        $errors = array();
		$p_id=null;
		$cl_id=null;
		$client = Clients::where('client_id',$client_id)->first();
        $cl_id = $client->id;
		$p_id = null;

		if(!$product_id){
			$status = false;
			$errors[] = trans('lang.product_id_required');
			$errors = implode(",", $errors);
            $apiData = MyModel::create(['client_id'=>$cl_id,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::ViewPackage]);
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}

		$product = Products::with('last_version')->where('product_id',$product_id)->first();
		if(!$product){
			$status = false;
			$errors[] = trans('lang.product_not_found').' ID:'.$product_id;
			$product_id=null;
		}else{
			$p_id = $product->id;
		}

		$check_clients_products = ClientsProducts::where('client_id',$cl_id)->where('product_id',$p_id)->first();
		if(!$check_clients_products){
			$status = false;
			$errors[] = trans('lang.product_does_not_bleongs_to_client');
		}

        $packages = ProductPackage::where('product_id',$p_id)->get();

		if($status == true){
			$status_data  = 1;
		}else{
			$status_data = 0;
		}
		$errors = implode(",", $errors);
		$apiData = MyModel::create(['product_id'=>$p_id,'client_id'=>$cl_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::ViewPackage]);
		if($status == true){

            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => true, 'data'=>$packages,'msg' => trans('lang.success') ,'errors'=>''],200);
		}else{

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}

    }
}
