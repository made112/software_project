<?php

namespace App\Http\Controllers\ApiCall\Product;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\Versions;
use App\Models\Clients;
use App\Models\LicensesUse;
use App\Notifications\DownloadModelNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use DB;
use App\Http\Requests\ApiCall\Product\LastVersionRequest;
use App\Models\ClientsProducts;
use App\Models\License;

class UpdateDownloadContoller  extends Controller
{

    protected $model;

	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

    public function UpdateDownload(Request $request){
		$client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
		$product_id = $request->get('product_id');
        $version_id = $request->get('version_id');
		$download_url = $request->get('download_url');
        $domain = \Request::root();
        $ip = \Request::ip();
		$status = true;
		$errors = array();
		$p_id = null;$cl_id=null;
		$client = Clients::where('client_id',$client_id)->first();
        $cl_id = $client->id;

		if(!$product_id or !$version_id or !$download_url or !filter_var($download_url, FILTER_VALIDATE_URL)){
			$status = false;
            if(!$product_id){
                $errors[] = trans('lang.product_id_required');
            }
            if(!$version_id){
                $errors[] = trans('lang.version_id_required');
            }
			if(!$download_url){
                $errors[] = trans('lang.download_url_required');
            }
			if(!filter_var($download_url, FILTER_VALIDATE_URL)){
				$errors[] = trans('lang.link_format');
			}
			$errors = implode(",", $errors);
            $apiData = MyModel::create(['product_id'=>$p_id,'download_url'=>$download_url,'client_id'=>$cl_id,'version_id'=>$version_id,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::UpdateDownloads]);
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
        }else{
			$licenses_ip = LicensesUse::where('license_id',$license->id)->where('ip',$ip)->first();
			if(!$licenses_ip){
				$status = false;
				$errors[] = trans('lang.ip_not_signed_in');
			}else{
				if($licenses_ip->is_activate == License::ACTIVATE){
					if($product->download_update == 1){
						if($license->date and $license->date < date('Y-m-d')){
							$status = false;
							$errors[] = trans('lang.license_expired');
						}
					}
					if($license->block == 1){
						$status = false;
						$errors[] = trans('lang.license_blocked').' License Code:'.$license_code;
						$version_id = null;
					}
				}else{
					$status = false;
					$errors[] = trans('lang.license_unactivated');
				}
			}
		}

		if($status == true){
			$status_data  = 1;
		}else{
			$status_data = 0;
			\Notification::route('mail',$client->email)->notify(new DownloadModelNotification([
                'title' => __('mail.fail_download_version'),
                'content' => __('mail.fail_download_version_content', ['version_name' => $version->name]),
                'product' =>  __('mail.product').': '.$version->product->name,
                'flag' => 2
            ]));
		}
		$errors = implode(",", $errors);
		$apiData = MyModel::create(['product_id'=>$p_id,'download_url'=>$download_url,'client_id'=>$cl_id,'version_id'=>$version_id,'status'=>$status_data,'license_code'=>$license_code,'api_key'=>$api_key,'ip'=>$ip,'domain'=>$domain,'validation_error'=>$errors,'function'=>MyModel::UpdateDownloads]);
		if($status == true){
			$version->update(['downloads' => $version->downloads+1]);
			\Notification::route('mail',$client->email)->notify(new DownloadModelNotification([
                'title' => __('mail.download_version'),
                'content' => __('mail.download_version_content', ['version_name' => $version->name]),
                'product' =>  __('mail.product').': '.$version->product->name,
                'flag' => 1
            ]));

            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => true, 'data'=>$version,'msg' => trans('lang.success'),'errors'=>''],200);
		}else{
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

			return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
		}

    }

}
