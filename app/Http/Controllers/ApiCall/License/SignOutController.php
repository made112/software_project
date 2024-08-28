<?php

namespace App\Http\Controllers\ApiCall\License;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\Clients;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use App\Models\License;
use DB;
use App\Models\LicensesUse;
use App\Models\Versions;
use App\Models\ClientsProducts;

class SignOutController  extends Controller
{

    protected $model;

	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

    public function signOut(Request $request){
        $client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $ip = \Request::ip();
		$status = true;
		$errors = array();
        $product_id = null;
		$cl_id = null;
        $client = Clients::where('client_id',$client_id)->first();
        $cl_id = $client->id;
        $p_id = null;
        $license = License::where('license_code',$license_code)->first();
        if(!$license){
            $status = false;
            $errors[] = trans('lang.license_code_not_found');
        }else{
            if($license->client_id != $cl_id){
                $status = false;
                $errors[] = trans('lang.license_code_does_not_belong_to_client');
            }
            $p_id = $license->product_id;
        }

        $licenses_ip = LicensesUse::where('license_id',$license->id)->where('ip',$ip)->first();
        if(!$licenses_ip){
            $status = false;
            $errors[] = trans('lang.IP_address_not_available');
        }

        if($status == true){
			$status_data  = 1;
		}else{
			$status_data = 0;
		}
		if($status == false){
            $errors = implode(",", $errors);
			$apiData = MyModel::create(['product_id'=>$p_id,'client_id'=>$cl_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'validation_error'=>$errors,'function'=>MyModel::SignOut]);

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}
        $licenses_ip->is_used = 0;
        $saved = $licenses_ip->save();
        $client->update([
            'last_seen_at' => Carbon::now(),
        ]);
        $errors = implode(",", $errors);
        $apiData = MyModel::create(['product_id'=>$p_id,'client_id'=>$cl_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'validation_error'=>$errors,'function'=>MyModel::SignOut]);



    }



}
