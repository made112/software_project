<?php


namespace App\Http\Controllers\Admin;

use App\Events\AddNewVersionEvent;
use App\Models\Setting;
use App\Models\Versions;
use App\Models\Versions as MyModel;
use App\Models\Products;
use App\Models\ApiCall;
use App\Notifications\AddNewVersionToProductNotification;
use App\Notifications\EditVersionNotification;
use App\Notifications\NewVersionToAdminNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\Versions\StoreVersionsRequest;
use App\Http\Requests\Admin\Versions\UpdateVersionsRequest;
use App\Models\User_Permission;
use App\Traits\FileUpload;
use DB;
use App\Models\Country;
use App\Jobs\SendEmailToClientsWithNewVersion;
use App\Jobs\SendEmailToClientsWithNewVersionSoon;

class VersionController extends AdminController
{

    protected $model;
    use FileUpload;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    //////////////////////////////////////////////

    /**
     * @param Request $request
     * @param $product_id
     * @return Application|Factory|View|string
     */
    public function index(Request $request, $product_id)
    {
        $product = Products::with('last_version')->find($product_id);
        if (!$product) {
            abort(404);
        }
        $versions = $this->model->filter($request->all());
        $versions = $versions->where('product_id', $product_id)->select('id', 'name', 'product_id', 'notification_summry', 'main_files', 'sql_files', 'publish_version', 'date', 'downloads', 'created_at')->orderBy('id', 'desc')->paginate(10);
        $data['versions'] = $versions;
        if ($request->ajax()) {
            return view('admin.versions.table-data', compact(['data', 'product_id', 'product']))->render();
        }
        return view('admin.versions.index', compact(['data', 'product_id', 'product']));
    }

    /**
     * @param Request $request
     * @param $product_id
     * @return Application|Factory|View
     */
    public function create(Request $request, $product_id)
    {
        $product = Products::find($product_id);
        if (!$product) {
            abort(404);
        }
        return view('admin.versions.create', compact(['product_id', 'product']));
    }

    /**
     * @param Request $request
     * @param $product_id
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function edit(Request $request, $product_id, $id)
    {
        $product = Products::find($product_id);
        if (!$product) {
            abort(404);
        }
        $versions = MyModel::where('id', $id)->first();
        if (!$versions) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return view('admin.versions.edit', compact(['versions', 'product_id', 'product']));
    }

    /**
     * @param StoreVersionsRequest $request
     * @return JsonResponse
     */
    public function add(StoreVersionsRequest $request)
    {
        $product_id = $request->get('product_id');
        $name = $request->get('name');
        $date = $request->get('date');
        $notification_summry = $request->get('notification_summry');
        $branch = $request->get('branch');
        $change_log = $request->get('change_log');
        $publish_version = $request->get('publish_version');
        $main_files = $request->file('main_files');
        $sql_files = $request->file('sql_files');

        $validated = $request->validated();
        if ($main_files) {
            $validated['main_files'] = $this->uploadFile($main_files);
        }
        if ($sql_files) {
            $validated['sql_files'] = $this->uploadFile($sql_files);
        }

        $version = new Versions();

        $version_exists = $version->checkVersion(1, $name, $product_id);

        if ( $version_exists > 0  ) {
            return response()->json(['status' => false, 'data' => trans('lang.version_exists')]);
        }

        $validated['user_id'] = \Auth::user()->id;
        $saved =  MyModel::create($validated);


        // New Version Event
        $product = Products::where('id', $product_id)->first();
        $user = $product->user;
        $product->user->notify(new AddNewVersionToProductNotification($user, $product));

        $admin = Setting::where('id', 1)->first();

        $admin->notify(new NewVersionToAdminNotification($admin, $product));

        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        if ($validated['publish_version'] == 1 and $validated['block'] == 0) {
            $checkJob = (new SendEmailToClientsWithNewVersion($saved));
            $job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($checkJob);
        } elseif ($validated['block'] == 0) {
            $checkJob = (new SendEmailToClientsWithNewVersionSoon($saved));
            $job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($checkJob);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    /**
     * @param UpdateVersionsRequest $request
     * @return JsonResponse
     */
    public function update(UpdateVersionsRequest $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        $product_id = $request->get('product_id');
        $name = $request->get('name');
        $date = $request->get('date');
        $notification_summry = $request->get('notification_summry');
        $change_log = $request->get('change_log');
        $publish_version = $request->get('publish_version');
        $main_files = $request->file('main_files');
        $sql_files = $request->file('sql_files');

        $validated = $request->validated();
        if ($main_files) {
            $validated['main_files'] = $this->uploadFile($main_files);
        }
        if ($sql_files) {
            $validated['sql_files'] = $this->uploadFile($sql_files);
        }

        $saved =  $obj->update($validated);

        // Send Email After Updated
        $product = Products::where('id', $product_id)->first();
        $user = $product->user;
        $user->notify(new EditVersionNotification($product, $user, $obj));

        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        if ($obj->downloads > 0) {
            return response()->json(['status' => false, 'data' => trans('lang.cannot_delete_version_has_downloads')]);
        }
        $check_api_call = ApiCall::where('function', 6)->where('version_id', $id)->first();
        if ($check_api_call) {
            return response()->json(['status' => false, 'data' => trans('lang.delete_version')]);
        }
        $deleted = $obj->delete();
        if (!$deleted) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function update_status(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        if ($obj->publish_version == MyModel::PUBLISHED) {
            $saved = $obj->update(['publish_version' => MyModel::UNPUBLISHED]);
        } else {
            $saved = $obj->update(['publish_version' => MyModel::PUBLISHED]);
        }
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }
}
