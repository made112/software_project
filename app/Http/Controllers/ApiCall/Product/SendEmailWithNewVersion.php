<?php

namespace App\Http\Controllers\ApiCall\Product;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ApiCall as MyModel;
use App\Models\Products;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use DB;
use App\Http\Requests\ApiCall\Product\LastVersionRequest;
use App\Models\Versions;
use App\Models\Clients;
use App\Models\ClientsProducts;
use App\Models\License;
use App\Jobs\SendEmailToClientsWithNewVersion;

class SendEmailWithNewVersion  extends Controller
{

    protected $model;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    public function SendEmailWithNewVersion(Request $request)
    {
        $versions = Versions::where('block',0)->where('publish_version',2)->where('date','<=',date('Y-m-d'))->get();
        if($versions){
            foreach($versions as $version){
                $checkJob = (new SendEmailToClientsWithNewVersion($version));
                $job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($checkJob);
                $version->publish_version = 1;
                $version->save();
            }
        }

    }
}