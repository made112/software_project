<?php

namespace App\Http\Controllers\ApiCall\Hashing;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use App\Services\License\HashService;

class HashingController extends Controller
{
    
    protected $hashService;

    public function __construct(HashService $hashService)
    {
        $this->hashService = $hashService;
    }

    public function decryption(Request $request){
        $file = $request->file('file');
        
        $rules =  [
            'file' => 'required',
        ];

        $messages = [
            'file.required' => trans('lang.file_required'),
            'file.mimes' => trans('lang.file_format').' txt',
        ];

        
        $validator = \Validator::make([
            'file' => $file,
        ],
            $rules
            ,
            $messages
        );
        
        if ($validator->fails()) {
            $all = collect($validator->errors()->getMessages())->map(function($item){
                return $item[0];
            });
              $strs = [];
            foreach ($all as $value) {
                $strs[]=  $value;
            }
            return response()->json(['status' => false , 'data' =>$strs]);
        }

        $data['ip'] = '217.0.0.1';
        $data['macaddress'] = '';
        $data['LicenseCode'] = '';
        $data['clientId'] = '';
        $data['productId'] = '';

        $productId = '';$clientId = '';$LicenseCode = '';$ip='';

        $unhash = $this->hashService->decryption($file,2);
        if(isset($unhash['productId'])){
            $productId = $unhash['productId'];
        }
        if(isset($unhash['clientId'])){
            $clientId = $unhash['clientId'];
        }
        if(isset($unhash['LicenseCode'])){
            $LicenseCode = $unhash['LicenseCode'];
        }
        if(isset($unhash['ip'])){
            $ip = $unhash['ip'];
        }
        // and $data['macaddress'] == $unhash['macaddress']
        // var_dump($unhash); exit;
        if($productId == $data['productId'] and $data['clientId'] == $clientId and $data['LicenseCode'] == $LicenseCode and $data['ip'] == $ip){
                if($unhash['endDate'] > date('Y-m-d')){
                    $hash['endDate'] = $unhash['endDate'];
                    $hasing = $this->hashService->encryption($hash,2);
                    return response()->json(['status' => true , 'data' => $hasing]);
                    // var_dump($hasing);exit;
                }
        }else{
            return response()->json(['status' => false , 'data' =>'Sorry, Data does not match']);
            // return false;
        }

    }
}
