<?php

namespace App\Http\Controllers\ApiCall\License;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\Clients;
use App\Models\LicensesUse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use App\Models\License;
use DB;
use App\Models\Versions;
use App\Models\ClientsProducts;
use App\Notifications\ActivationModelNotification;

class DeactivateLicenseContoller  extends Controller
{

    protected $model;

	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

	public function DeactivateLicense(Request $request){
		$client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $domain = \Request::root();
        $ip = \Request::ip();
		$status = true;
		$errors = array();
		$product_id = null;
		$cl_id = null;
        $client = Clients::where('client_id',$client_id)->first();
        $cl_id = $client->id;

		$license = License::where('license_code',$license_code)->where('client_id',$cl_id)->first();
        if(!$license){
            $status = false;
            $errors[] = trans('lang.license_code_not_found');
        }

		if($license->usage == License::DEACTIVATE){
			$status = false;
            $errors[] = trans('lang.license_already_deactivated');
		}

		if($license){
			$product_id = $license->product_id;
		}

		$licenses_ip = LicensesUse::where('license_id',$license->id)->where('ip',$ip)->first();
        if(!$licenses_ip){
            $status = false;
            $errors[] = trans('lang.ip_not_signed_in');
        }else{
            if($licenses_ip->is_used == 0 and $license->type == 1){
                $status = false;
                $errors[] = trans('lang.ip_not_signed_in');
            }
        }

		if($status == true){
			$status_data  = 1;
		}else{
			$status_data = 0;
		}
		$errors = implode(",", $errors);

		if($status == false){
			$apiData = MyModel::create(['product_id'=>$product_id,'client_id'=>$cl_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::DeactivateLicense]);
			return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}
		DB::beginTransaction();
        try {

			$licenses_ip->is_activate = 0;
            $licenses_ip->save();

			$license_activate_cnt = LicensesUse::where('license_id',$license->id)->where('is_activate',1)->count();
			if($license_activate_cnt == 0){
				$license->update(['usage'=>License::DEACTIVATE]);
			}
			$apiData = MyModel::create(['product_id'=>$product_id,'client_id'=>$cl_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::DeactivateLicense]);
			\Notification::route('mail',$client->email)->notify(new ActivationModelNotification([
                'title' => __('mail.unactivate_license_title'),
                'content' => __('mail.unactivate_license_content', ['license_name' => $license->name]),
                'license_code' =>  __('mail.license_code').': '.$license->license_code,
                'product' =>  __('mail.product').': '.$license->product->name,
				'ip' => 'IP: '.$ip,
                'flag' => 2
            ]));


			DB::commit();

            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

            return response()->json(['status' => true, 'data'=>$license,'msg' => trans('lang.success') ,'errors'=>''],200);

        } catch (\Exception $e) {
            DB::rollback();
			$apiData = MyModel::create(['product_id'=>$product_id,'client_id'=>$cl_id,'status'=>0,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'errors'=>$e,'function'=>MyModel::DeactivateLicense]);

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors.','.$e],422);
        }

	}

}
