<?php

namespace App\Http\Controllers\ApiCall\Product;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\Clients;
use App\Models\Versions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use DB;
use App\Http\Requests\ApiCall\Product\LastVersionRequest;
use App\Models\ClientsProducts;
use App\Models\License;

class CheckUpdateVersionContoller  extends Controller
{

    protected $model;

	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

    public function CheckUpdate(Request $request){
		$client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
		$product_id = $request->get('product_id');
        $version_id = $request->get('version_id');
        $has_new_version = false;
        $domain = \Request::root();
        $ip = \Request::ip();
		$status = true;
		$errors = array();

		$cl_id = null;
        // Get Client
        $client = Clients::query()->where('client_id',$client_id)->first();
        $cl_id = $client->id;
		$p_id = null;


		if(!$product_id or !$version_id){
			$status = false;
            if(!$product_id){
                $errors[] = trans('lang.product_id_required');
            }
            if(!$version_id){
                $errors[] = trans('lang.version_id_required');
            }
			$errors = implode(",", $errors);
            $apiData = MyModel::create(['product_id'=>$p_id,'client_id'=>$cl_id,'version_id'=>$version_id,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::CheckUpdate]);
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}

		$product = Products::with('last_version')->where('product_id',$product_id)->first();
		if(!$product){
			$status = false;
			$errors[] = trans('lang.product_not_found').' ID:'.$product_id;
			$product_id = null;
		}else{
			$p_id = $product->id;
			if($product->status == 2){
				$status = false;
				$errors[] = trans('lang.product_is_inactive').' ID:'.$product_id;
				$product_id = null;
			}
		}

        // Get Version
        $version = Versions::with('product')->where('block',0)->where('id',$version_id)->first();

        if(!$version){
			$status = false;
			$errors[] = trans('lang.version_not_found').' ID:'.$version_id;
			$version_id = null;
		}else{
			if($version->block == 1){
				$status = false;
				$errors[] = trans('lang.version_blocked').' ID:'.$version_id;
				$version_id = null;
			}
		}

		$check_clients_products = ClientsProducts::where('client_id',$cl_id)->where('product_id',$p_id)->first();
		if(!$check_clients_products){
			$status = false;
			$errors[] = trans('lang.product_does_not_bleongs_to_client');
		}


		$license = License::where('license_code',$license_code)->where('product_id',$p_id)->where('client_id',$cl_id)->first();
        if(!$license){
            $status = false;
            $errors[] = trans('lang.license_code_not_found');
        }

		if($status == true){
			$status_data  = 1;
            if($product->last_version and $product->last_version->id > $version->id){
                $has_new_version = true;
				$version = Versions::with('product')->where('block',0)->where('publish_version',1)->where('product_id',$product->id)->orderBy('id','desc')->first();
            }
		}else{
			$status_data = 0;
		}
		$errors = implode(",", $errors);
		$apiData = MyModel::create(['product_id'=>$p_id,'client_id'=>$cl_id,'version_id'=>$version_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::CheckUpdate]);


        if ($license->date < Carbon::now() && $has_new_version == true ) {
            if ($product->download_update == 1) {
                return response()->json(['status' => true, 'data'=> $version,'has_new_version'=> $has_new_version , 'can_you_update' => false ,'msg' => trans('lang.license_can_update'),'errors'=>''],200);
            }elseif ($product->download_update == 0) {
                return response()->json(['status' => true, 'data'=> $version,'has_new_version'=> $has_new_version , 'can_you_update' => true ,'msg' => trans('lang.license_can_not_update'),'errors'=>''],200);
            }
        }


		if($status == true){

            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => true, 'data'=> $version, 'can_you_update' => true ,'has_new_version'=>$has_new_version ,'msg' => trans('lang.success'),'errors'=>''],200);
		}else{
            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}

    }

}
