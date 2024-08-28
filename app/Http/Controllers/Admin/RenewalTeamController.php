<?php


namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\License as MyModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ClientsProducts;
use App\Models\ClientUserProduct;
use App\Models\ClientUser;
use App\Models\Clients;
use App\Models\Products;
use App\Models\LicensesUse;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\License\StoreLicenseRequest;
use App\Http\Requests\Admin\License\UpdateLicenseRequest;
use App\Http\Helpers\Helpers;
use App\Traits\FileUpload;
use App\Models\User_Permission;
use DB;
use App\Models\Country;
use App\Http\Requests\Admin\License\EmailRequest;
use App\Notifications\LicensesNotification;
use App\Notifications\LicensesHashServiceNotification;
use App\Http\Controllers\Admin\HashingController;
use App\Services\License\HashService;

class RenewalTeamController extends AdminController
{

    protected $model;
    protected $hashService;
    use FileUpload;

    public function __construct(MyModel $model, HashService $hashService)
    {
        $this->model = $model;
        $this->hashService = $hashService;
    }

    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $licenses = $this->model->filter($request->all());
        if ($request->from) {
            $licenses = $licenses->where('date', '>=', $request->from);
        }
        if ($request->to) {
            $licenses = $licenses->where('date', '<=', $request->to);
        }
        if ($request->usage == "1" or strVal($request->usage) == "0") {
            $licenses = $licenses->where('usage', $request->usage)->where('date', '>', date('Y-m-d'));
        } elseif ($request->usage == "2") {
            $licenses = $licenses->where('date', '<=', date('Y-m-d'));
        }

        $licenses = $licenses->with(['client.projects_manager.manager', 'product'])
            ->select('id', 'client_id', 'date', 'license_code', 'type', 'updated_at', 'parallel_use_limit', 'usage', 'product_id', 'use_limit as use_limit_lin', 'block', 'block as status_name', 'uses_left', 'created_at')
            ->orderBy('date', 'asc')
            ->where(function ($query) {
                $query->where('date', '>', (Carbon::now()->subDays(8)));
            })
            ->paginate(20);

        $data['licenses'] = $licenses;

        if ($request->ajax()) {
            return view('admin.renewal-team.table-data', compact('data'))->render();
        }
        return view('admin.renewal-team.index', compact('data'));
    }
}
