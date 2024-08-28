<?php


namespace App\Http\Controllers\Admin;

use App\Http\Helpers\Helpers;
use App\Models\Setting as MyModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\Setting\UpdateSettingReqeust;
use App\Http\Requests\Admin\Setting\UpdateApiSettingRequest;
use App\Http\Requests\Admin\Setting\StoreApiKeyRequest;
use App\Models\User_Permission;
use DB;
use App\Models\Country;
use App\Models\ApiKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingController extends AdminController
{

    protected $model;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data['setting'] = MyModel::where('id', 1)->first();
        $data['tzlist'] = Helpers::GetTimeZone();
        return view('admin.setting.index', compact('data'));
    }

    public function api_setting(Request $request)
    {
        $data['setting'] = MyModel::where('id', 1)->first();
        $data['api_key'] = ApiKey::select('id', 'api_key', 'api_key_type', 'special_permission', 'created_at')->get();
        return view('admin.setting.api', compact('data'));
    }

    public function update(UpdateSettingReqeust $request)
    {
        $timezone = $request->get('timezone');
        $setting = MyModel::first();
        $validated = $request->validated();
        $saved =  $setting->update($validated);
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        config()->set('app.timezone', $timezone);
        Cache::forget('settings');
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function update_api_setting(UpdateApiSettingRequest $request)
    {
        $setting = MyModel::where('id', 1)->first();
        $validated = $request->validated();
        $saved =  $setting->update($validated);
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function get_api_key(Request $request)
    {
        $data = ApiKey::select('id', 'api_key', 'api_key_type', 'special_permission', 'created_at')->get();
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function add_api_key(StoreApiKeyRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = \Auth::user()->id;
        $saved =  ApiKey::create($validated);
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function delete_api_key(Request $request)
    {
        $id = $request->get('id');
        $a = ApiKey::where('id', $id)->first();
        if (!$a) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        $deleted = $a->delete();
        if (!$deleted) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }
}
