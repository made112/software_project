<?php


namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Spatie\Permission\Models\Role as  MyModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleReqeust;
use DB;
use App\Models\Country;

class RoleController extends AdminController
{

    protected $model;

	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

    public function index(Request $request){
        $data['roles'] = MyModel::get();
        if ($request->ajax()) {
            return view('admin.roles.table-data', compact('data'))->render();
        }
        return view('admin.roles.index',compact('data'));
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $role = MyModel::where('id',$id)->first();
        if($role != ''){
            return response()->json(['status' => true , 'data' => $role]);
        }else{
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
    }

    public function add(UpdateRoleReqeust $request){
        $name = $request->get('name');
        $validated = $request->validated();
        $validated['guard_name'] = 'web';
        $saved =  MyModel::create($validated);
        if(!$saved){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true , 'data' => trans('lang.success')]);
    }

    public function update(StoreRoleRequest $request){
        $id = $request->get('hidden');
        $obj = MyModel::where('id',$id)->first();
        if(!$obj){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        $name = $request->get('name');
        $validated = $request->validated();
        $saved =  $obj->update($validated);
        if(!$saved){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true , 'data' => trans('lang.success')]);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $obj = MyModel::where('id',$id)->first();
        if(!$obj){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        $deleted = $obj->delete();
        if(!$deleted){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true , 'data' => trans('lang.success')]);
    }

    public function permissionRole(Request $request){
        $lang = \App::getLocale();
        $id = $request->get('id');
        $role = MyModel::find($id);
        $user_permissions = $role->permissions;
        $permissions = Permission::orderBy('group_id','asc')->orderBy('id','asc')->get(['id',"name_$lang as name",'name as name_en','group_id','group']);
        $permissions = $permissions->groupBY('group_id');
        $user_per ='';
        $per_group = 0;
        $checked ='';
        $i = 0;
        $z = 0;
        $margin_top = 0;
        $view = view('admin.roles.sub.permission', compact(['permissions','user_permissions']))->render();
        return response()->json(['data'=>$view]);
    }


    public function permission(Request $request){
        $hidden = $request->get('hidden');
        $permissions = $request->get('permissions');
        $role = MyModel::find($hidden);
        if($role != ''){
            $user_permissions = $role->permissions;
            foreach($user_permissions as $per){
                $perm = Permission::find($per->permission_id);
                $role->revokePermissionTo($perm);
            }
            if($permissions){
                foreach($permissions as $permission){
                        $perm = Permission::find($permission);
                        $role->givePermissionTo($perm->name);
                }
            }
               return response()->json(['status' => true , 'data' => trans('lang.success')]);
        }else{
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
    }

}