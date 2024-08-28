<?php

namespace App\Http\Controllers\ApiCall\Payment;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Payment as MyModel;
use App\Models\Products;
use App\Models\Clients;
use App\Models\ProductPackage;
use App\Models\ProductPackagePrice;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use App\Models\License;
use DB;
use App\Models\Versions;
use App\Models\ClientsProducts;
use App\Services\Payment\Payment;
use Illuminate\Support\Facades\Redirect;
use App\Http\Helpers\Helpers;

class PaymentController  extends Controller
{

    protected $model;
    protected $payment;

	public function __construct(MyModel $model,Payment $payment)
	{
		$this->model = $model;
        $this->payment = $payment;
	}


    public function payments(Request $request){
        $client_id = $request->header('client-id');
        $api_key = $request->header('api-key');
        $domain = $request->get('domain');
        $duration = $request->get('license_duration');
        $support_duration = $request->get('support_duration');
        $support_type = $request->get('support_type');
        $package_id = $request->get('package_id');
        $package_price_id = $request->get('package_price_id');
        $product_id = null;
        $ip = \Request::ip();
        $status = true;
        $errors = array();

        if ($client_id == '' or $duration == '' or $domain == '' or $api_key == ''  or $support_type == '' or $support_duration == '' or $package_id == '') {
            $status = false;
            if ($client_id == '') {
                $errors[] = trans('lang.client_required');
            }
            // if ($domain == '') {
            //     $errors[] = trans('lang.domain_required');
            // }
            if ($api_key == '') {
                $errors[] = trans('lang.api_key_required');
            }
            if ($duration == '') {
                $errors[] = trans('lang.license_duration_required');
            }
            if ($support_type == '') {
                $errors[] = trans('lang.support_type_required');
            }
            if ($package_id == '') {
                $errors[] = trans('lang.package_id_required');
            }
            if($support_duration == ''){
                $errors[] = trans('lang.support_duration_required');
            }
        }

        if($support_type != 2 and $support_type != 3 and $support_type != ''){
            $status = false;
            $errors[] = trans('lang.support_type_is_wrong');
        }

        $cl_id = null;
        $p_id=null;
        $client = Clients::where('client_id',$client_id)->first();
        if (!$client) {
            $status = false;
            $errors[] = trans('lang.client_not_found').' ID:'.$client_id;
            $client_id = null;
        }else{
            $cl_id = $client->id;
        }

        $package = ProductPackage::where('id',$package_id)->first();
        if(!$package){
            $status = false;
            $errors[] = trans('lang.package_not_found').' ID:'.$package_id;
            $package_id = null; 
        }else{
            $product_id = $package->product_id;
            if($package->status == 0){
                $status = false;
                $errors[] = trans('lang.package_inactive');
            }
            if($package->type == 2){
                if ($domain == '') {
                    $status = false;
                    $errors[] = trans('lang.domain_required');
                }
            }
        }
        

        if($product_id){
            $product = Products::with('last_version')->where('id',$product_id)->first();
    		if(!$product){
                $status = false;
                $errors[] = trans('lang.product_not_found').' ID:'.$product_id;
                $product_id=null;
            }else{
                $p_id = $product->id;
            }
        }

        if ($status == false) {
            $errors = implode(",", $errors);
            $payment_data = MyModel::create(['api_key'=>$api_key,'package_id'=>$package_id,'support_duration'=>$support_duration,'client_id'=>$cl_id,'domain'=>$domain,'product_id'=>$p_id,'duration'=>$duration,'support_type'=>$support_type,'ip'=>$ip,'validation_error'=>$errors]);
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
        }

        $package_price = ProductPackagePrice::where('product_id',$product_id)->where('related_to',1)->whereRaw(''.$duration.' between `from` and `to`')->first();
        if(!$package_price){
            $status = false;
            $errors[] = trans('lang.duration_license_out_of_range').' Duration:'.$duration;
            $package_price_id = null; 
        }
        
        if($package->type == 2){
            $price_supp = 0;
            if($support_type){
                $support_type_price  = ProductPackagePrice::where('product_id',$product_id)->whereRaw(''.$support_duration.' between `from` and `to`');
                $support_type_price = $support_type_price->where('related_to',$support_type);
                // if($support_type == 2){
                // }else{
                //     $support_type_price = $support_type_price->where('related_to',3);
                // }
                $support_type_price  = $support_type_price->first();
                if($support_type_price){
                    $price_supp =  $support_type_price->price;
                }else{
                    $status = false;
                    $errors[] = trans('lang.duration_support_out_of_range').' Duration:'.$support_duration;
                }
            }
            
            $price = 0;
            $refrence_no = \Str::random(20);
            if($status == true){
                $status_data  = 1;
                $price = $package_price->price;
                $price = $price + $price_supp;
                $json_response = $this->payment->payment($client,$package,$package_price,$price_supp,$price,$domain,$refrence_no);
                if($json_response['IsSuccess'] == false){
                    if($json_response['ValidationErrors']){
                        foreach($json_response['ValidationErrors'] as $ValidationErrors){
                            $errors[] = $ValidationErrors['Error'];
                        }
                        $errors = implode(",", $errors);
                        $payment_data = MyModel::create(['api_key'=>$api_key,'refrence_no'=>$refrence_no,'price'=>$price,'package_id'=>$package_id,'client_id'=>$cl_id,'domain'=>$domain,'product_id'=>$p_id,'support_duration'=>$support_duration,'duration'=>$duration,'support_type'=>$support_type,'ip'=>$ip,'validation_error'=>$errors]);
                        return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
                    }      
                }else{
                    $redirect_url = $json_response['Data']['PaymentURL'];
                    $payment_data = MyModel::create(['api_key'=>$api_key,'refrence_no'=>$refrence_no,'price'=>$price,'redirect_url'=>$redirect_url,'status'=>1,'support_duration'=>$support_duration,'package_id'=>$package_id,'client_id'=>$cl_id,'domain'=>$domain,'product_id'=>$p_id,'duration'=>$duration,'support_type'=>$support_type,'ip'=>$ip]);
                    return response()->json(['status' => true, 'data'=>$redirect_url,'msg' => trans('lang.success')],200);
                }

                

            }else{
                $errors = implode(",", $errors);
                $payment_data = MyModel::create(['api_key'=>$api_key,'refrence_no'=>$refrence_no,'price'=>$price,'package_id'=>$package_id,'client_id'=>$cl_id,'domain'=>$domain,'support_duration'=>$support_duration,'product_id'=>$p_id,'duration'=>$duration,'support_type'=>$support_type,'ip'=>$ip,'validation_error'=>null]);
                return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.error') ,'errors'=>$errors],422);
            }
        }else{
            $setting = Setting::first();
            $license_code = Helpers::GenerateLicenses($setting->license_code);
            $client_id = $cl_id;
            $product_id = $package->product_id;
            $license_type = 1;
            $support_type = $support_type;
            $date = date('Y-m-d', strtotime(date('Y-m-d'). " + $package->duration days"));
            $days = $package->duration;
            $price = 0;
            $license = License::create([
                'product_id'=>$product_id,'license_code'=>$license_code,'client_id'=>$client_id,
                'type'=>$license_type,'support_type'=>$support_type,'days'=>$days,
                'date'=> $date,'use_limit'=>1,'parallel_use_limit'=>1,'price'=>$price,
                'ip'=>$ip,'domains'=>$domain,'user_id'=>1,'payment_type'=>3
            ]);
            $payment_data = MyModel::create(['api_key'=>$api_key,'refrence_no'=>null,'price'=>$price,'support_duration'=>$support_duration,'redirect_url'=>null,'status'=>1,'package_id'=>$package_id,'client_id'=>$cl_id,'domain'=>$domain,'product_id'=>$p_id,'duration'=>$duration,'support_type'=>$support_type,'ip'=>$ip,'license_id'=>$license->id]);
            return response()->json(['status' => true, 'data'=>null,'msg' => trans('lang.adding_license_automatically')],200);
        }


    }

    public function success(Request $request){
        \App::setLocale('en');
        $paymentId = Request()->paymentId;
        $refrence_no = Request()->refrence_no;
        $payment = MyModel::where('refrence_no',$refrence_no)->first();
        if(!$payment){
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.payment_no_found')],422);
        }
        $domain = $payment->domain;
        $errors = array();
        DB::beginTransaction();
        try {

            $license_id = null;
            $status = 2;
            $json_response = $this->payment->getPaymentStatus($paymentId);
            if($json_response['IsSuccess'] == true){ 
                $setting = Setting::first();
                $license_code = Helpers::GenerateLicenses($setting->license_code);
                $product_id = $payment->product_id;
                $client_id = $payment->client_id;
                $product_id = $payment->product_id;
                $license_type = 1;
                $ip = $payment->ip;
                $support_type = $payment->support_type;

                $package = ProductPackage::where('id',$payment->package_id)->first();
                if($package->duration_type == 1){
                    $days = $payment->duration*365;
                    $date = date('Y-m-d', strtotime(date('Y-m-d'). " + $payment->duration year"));
                }else{
                    $days = $payment->duration*30;
                    $date = date('Y-m-d', strtotime(date('Y-m-d'). " + $payment->duration month"));
                }
               
                $package_price = ProductPackagePrice::where('id',$payment->package_price_id)->first();
                $price = $payment->price;

                $license = License::create([
                                    'product_id'=>$product_id,'license_code'=>$license_code,'client_id'=>$client_id,
                                    'type'=>$license_type,'support_type'=>$support_type,'days'=>$days,
                                    'date'=> $date,'use_limit'=>1,'parallel_use_limit'=>1,'price'=>$price,
                                    'ip'=>$ip,'domains'=>$domain,'user_id'=>1,'payment_type'=>3
                                ]);
                $license_id = $license->id;
            }else{
                $status = 3;
                if($json_response['ValidationErrors']){
                    foreach($json_response['ValidationErrors'] as $ValidationErrors){
                        $errors[] = $ValidationErrors['Error'];
                    }
                }  
            }
            $errors = implode(",", $errors);
            $payment->update(['payment_id'=>$paymentId,'status'=>$status,'validation_error'=>$errors,'license_id'=>$license_id]);
            
            DB::commit();
            if($status == 2){
                $msg = trans('lang.success');
                return view('site.payment-success',compact('domain','msg'));
                return Redirect::to($domain.'?status=true&message='.trans('lang.success'));
            }else{
                $msg = trans('lang.error');
                return view('site.payment-failed',compact('errors','domain','msg'));
                return Redirect::to($domain.'?status=false&data='.$errors.'&message='.trans('lang.error'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            $payment->update(['payment_id'=>$paymentId,'status'=>3,'error'=>$e->getMessage()]);

        }

        $msg = trans('lang.error');
        return view('site.payment-failed',compact('domain','msg'));
        return Redirect::to($domain.'?status=false&message='.trans('lang.error'));
        
    }
    

    public function faild(Request $request){
        \App::setLocale('en');
        $paymentId = Request()->paymentId;
        $refrence_no = Request()->refrence_no;
        $payment = MyModel::where('refrence_no',$refrence_no)->first();
        if(!$payment){
            return response()->json(['status' => false, 'data'=>'','msg' => trans('lang.payment_no_found')],422);
        }   
        $domain = $payment->domain;
        $status = 3;
        $errors = array();
        DB::beginTransaction();
        try {

            $json_response = $this->payment->getPaymentStatus($paymentId);
            if($json_response['IsSuccess'] == false){ 
                if($json_response['ValidationErrors']){
                    foreach($json_response['ValidationErrors'] as $ValidationErrors){
                        $errors[] = $ValidationErrors['Error'];
                    }
                }   
            }elseif($json_response['IsSuccess'] == true){
                if(isset($json_response['Data']['InvoiceTransactions'][0])){
                    $errors[] = $json_response['Data']['InvoiceTransactions'][0]['Error'];
                }
            }
            $errors = implode(",", $errors);
            $payment->update(['payment_id'=>$paymentId,'status'=>$status,'error'=>$errors]);
            DB::commit();
            $msg = trans('lang.error');
            return view('site.payment-failed',compact('errors','domain','msg'));
            return Redirect::to($domain.'?status=false&data='.$errors.'&message='.trans('lang.error'));

        } catch (\Exception $e) {
            DB::rollback();
            $payment->update(['payment_id'=>$paymentId,'status'=>$status,'error'=>$e->getMessage()]);
        }

        $msg = trans('lang.error');
     
        return view('site.payment-failed',compact('domain','msg'));
        return Redirect::to($domain.'?status=false&message='.trans('lang.error'));

    }
}