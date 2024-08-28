<?php

namespace App\Http\Controllers\ApiCall\License;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use App\Models\LicensesUse;
use App\Models\Clients;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use App\Models\License;
use DB;
use App\Models\Versions;
use App\Models\ClientsProducts;
use App\Services\License\HashService;

class CheckAvailabilityLicenseController  extends Controller
{

    protected $model;
    public $hashService;
    public function __construct(MyModel $model)
    {
        $this->hashService = new HashService;
        $this->model = $model;
    }

    public function CheckAvailabilityLicense(Request $request)
    {
        try {
        
        $client_id = $request->header('client-id');
        $license_code = $request->header('license-code');
        $api_key = $request->header('api-key');
        $domain = \Request::root();
        $ip = \Request::ip();
        $status = true;
        $errors = array();
        $product_id = null;

        $cl_id = null;
        $client = Clients::where('client_id', $client_id)->first();
        $cl_id = $client->id;


        $validator = \Validator::make($request->all(), [
            'encrypted_data' => ['required'],
            'public_key' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $validator->errors()], 422);
        }

        $bodyData = $validator->validated();

        $unhash = (new HashService)->SSLDecrypt($bodyData['encrypted_data'], $bodyData['public_key']);


        $license = License::where('license_code', $license_code)->where('client_id', $cl_id)->first();
        if (!$license) {
            $status = false;
            $errors[] = trans('lang.license_code_not_found');
        } else {
            if ($license->block == 1) {
                $status = false;
                $errors[] = trans('lang.license_is_blocked');
            }
            if ($license->date < date('Y-m-d')) {
                $status = false;
                $errors[] = trans('lang.license_is_expired');
            }
            $licenses_ip = LicensesUse::where('license_id', $license->id)->where('ip', $ip)->first();

            return $licenses_ip;
            if (!$licenses_ip) {
                $status = false;
                $errors[] = trans('lang.ip_not_signed_in');
            } else {
                if ($licenses_ip->is_used == 0 and $license->type == 1) {
                    $status = false;
                    $errors[] = trans('lang.ip_not_signed_in');
                }
            }
        }

        if ($license) {
            $product_id = $license->product_id;
        }

        $unhash = [
            "product_id" => Products::find($license->product_id)->product_id,
            "client_id" => $client_id,
            "date" => $license->date,
            "license_code" => $license->license_code,
            "days" => $license->days,
            "end_days" => "0",
            "startDate" => date('Y-m-d'),
            "last_check_date" => now(),
            "endDate" => $license->date,
            "ip" => $licenses_ip->ip,
            "uuid" => $licenses_ip->uuid,
            "macaddress" => $licenses_ip->mac_address
        ];

        // $unhash = [
        //     "product_id" => $license->product_id,
        //     "client_id" => $client_id,
        //     "date" => $license->date,
        //     "license_code" => $license->license_code,
        //     "days" => $license->days,
        //     "end_days" => "0",
        //     "startDate" => date('Y-m-d'),
        //     "endDate" => $license->date,
        //     "ip" => $licenses_ip->ip,
        //     "uuid" => $licenses_ip->uuid,
        // ];

        // return $unhash;

        $encryptedLicense = $this->hashService->SSLEncrypt(json_encode($unhash));

        if ($status == true) {
            $status_data  = 1;
        } else {
            $status_data = 0;
        }
        $errors = implode(",", $errors);

        $apiData = MyModel::create(['product_id' => $product_id, 'client_id' => $cl_id, 'status' => $status_data, 'license_code' => $license_code, 'api_key' => $api_key, 'ip' => $ip, 'domain' => $domain, 'validation_error' => $errors, 'function' => MyModel::CheckAvailabilityLicense]);
        if ($status == true) {
            // Set ( Last Seen At )
            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

            return response()->json(['status' => true, 'data' => $encryptedLicense, 'msg' => trans('lang.success'), 'errors' => ''], 200);
        } else {

            $client->update([
                'last_seen_at' => Carbon::now(),
            ]);

            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => $errors], 422);
        }
            //code...
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => '', 'msg' => trans('lang.error'), 'errors' => [$th->getMessage()]], 422);

        }
    }
}
