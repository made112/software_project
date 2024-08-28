<?php


namespace App\Http\Controllers\Admin;

use App\Models\Notifications;
use App\Models\Notifications as MyModel;
use App\Models\Setting;
use App\Models\NotificationsClients;
// use App\Notifications\SendNotification;
use App\Models\Clients;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\Notifications\StoreNotificationsRequest;
use App\Http\Requests\Admin\Notifications\UpdateNotificationsRequest;
use App\Models\User_Permission;
use DB;
use App\Models\Country;
use App\Jobs\SendNotification;
use App\Models\ClientsProducts;

class NotificationController extends AdminController
{

    protected $model;

    public function __construct(MyModel $model)
    {
        $this->model = $model;
    }

    //////////////////////////////////////////////

    public function index(Request $request)
    {
        $notifications = $this->model->filter($request->all());
        if($request->from){
            $notifications = $notifications->where('created_at','>=',$request->from);
        }
        if($request->to){
            $notifications = $notifications->where('created_at','<=',$request->to);
        }
        $notifications = $notifications->select('id', 'date', 'channel_id', 'status', 'channel_id as channel', 'is_send','created_at', 'status as status_name', 'notification_title')->orderBy('id', 'desc')->paginate(10);
        $data['notifications'] = $notifications;
        if ($request->ajax()) {
            return view('admin.notifications.table-data', compact('data'))->render();
        }
        return view('admin.notifications.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('admin.notifications.create');
    }

    public function edit(Request $request, $id)
    {
        $notifications = MyModel::with(['clients.client', 'product'])->where('id', $id)->first();


        $client_notification = NotificationsClients::where('notification_id', $notifications->id)->whereNull('deleted_at')->get();

        $array_or_clients = [];
        if( count($client_notification) > 0 && $notifications->id ){
            foreach ( $client_notification as $client ) {
                $array_or_clients[] = Clients::where('id', $client->client_id)->first();
            }
        }elseif( count($client_notification) == 0 && $notifications->id ) {
            foreach ( Clients::all() as $client ) {
                $array_or_clients[] = Clients::where('id', $client->id)->first();
            }
        }


        if (!$notifications) {
            abort(404);
        }
        if ($notifications->is_send == 1) {
            return redirect('/admin/notifications');
        }
        return view('admin.notifications.edit', compact(['notifications', 'id', 'array_or_clients']));
    }

    public function view(Request $request, $id)
    {
        $notifications = MyModel::with(['clients.client', 'product'])->where('id', $id)->first();
        if (!$notifications) {
            abort(404);
        }
        return view('admin.notifications.view', compact(['notifications', 'id']));
    }

    public function add(StoreNotificationsRequest $request)
    {
        $date = date('Y-m-d H:i');
        if ($request->status == 1) {
            $request->date = $date;
        }

        $request->date = date('Y-m-d H:i',strtotime($request->date));
        $validated = $request->validated();
        $validated['user_id'] = \Auth::user()->id;

        DB::beginTransaction();
        try {

            $saved =  MyModel::create($validated);
            if (!$saved) {
                return response()->json(['status' => false, 'data' => trans('lang.error')]);
            }


            $details = array();
            $details['notification'] = $saved;
            $client_id = $request->get('client_id');
            $product_id = $request->get('product_id');
            $job_id = '';
            $details['client'] = $client_id;

            $all_client = ClientsProducts::where('product_id',$product_id);
            if($client_id){
                $all_client = $all_client->whereIn('client_id',$client_id);
            }
            $all_client = $all_client->pluck('client_id')->ToArray();

            if ($all_client) {
                foreach ($all_client as $client) {
                    $saved->clients()->save(new NotificationsClients(["client_id" => $client]));
                }
            }

            $details['client_ids'] = $all_client;
            if ($request->channel_id == MyModel::EMAIL) {
                if ($request->status == 1) {
                    $checkAdminUserNotificationJob = (new SendNotification($details));
                } else {
                    $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i',$request->date);
                    $checkAdminUserNotificationJob = (new SendNotification($details))->delay($timestamp);
                }
                $job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($checkAdminUserNotificationJob);
                $saved->update(['job_id' => $job_id]);
            }

            DB::commit();
            return response()->json(['status' => true, 'data' => trans('lang.success')]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
        return response()->json(['status' => false, 'data' => trans('lang.error')]);
    }

    public function update(UpdateNotificationsRequest $request)
    {

        $data = $request->validated();
        $id = $request->get('id');

        try{
            DB::beginTransaction();

            $notification = MyModel::findOrFail($id);
            $notification->update($data);

            $notification->job()->delete();
            $notification->clients()->delete();

            if (isset($data['client_id']) && count( $data['client_id'] )) {
                foreach ( $data['client_id'] as $client_id){
                    NotificationsClients::create([
                        'client_id' => $client_id,
                        'notification_id' => $notification->id,
                    ]);
                }
            }

            if ($request->channel_id == MyModel::EMAIL) {
                if ($request->status == 1) {
                    $checkAdminUserNotificationJob = (new SendNotification(['notification' => $notification, 'client_ids' => $data['client_id']]));
                } else {
                    $timestamp = \Carbon\Carbon::parse($data['date'])->timestamp;
                    $checkAdminUserNotificationJob = (new SendNotification(['notification' => $notification, 'client_ids' => $data['client_id'] ]))->delay($timestamp);
                }
                $job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($checkAdminUserNotificationJob);
                $notification->update(['job_id' => $job_id]);
            }

            DB::commit();
            return response()->json(['status' => true, 'data' => trans('lang.success')]);

        }catch (Exception $e) {
            DB::rollBack();

            return response()->json(['status' => false, 'data' => trans('lang.error', ), 'fail' => $e->getMessage() ]);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }

        DB::beginTransaction();
        try {

            $obj->job()->delete();
            $obj->clients()->delete();
            $deleted = $obj->delete();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => trans('lang.error')]);
            }

            DB::commit();
            return response()->json(['status' => true, 'data' => trans('lang.success')]);
        } catch (\Exception $e) {
            DB::rollback();
        }
        return response()->json(['status' => false, 'data' => trans('lang.error')]);
    }
}
