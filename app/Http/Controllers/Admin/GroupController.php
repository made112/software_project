<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupRole;
use App\Models\User_Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GroupController extends Controller
{

    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Request $request): string
    {

        $groups = $this->model->filter( $request->all() );

        $roles = Role::all();

        $groups =  $groups->with('roles')->select('id', 'name', 'name_ar', 'created_at')->orderBy('created_at', 'desc')->paginate(10);

        if( $request->ajax() ){

            return view('admin.group.table-data', compact('groups', 'roles'))->render();
        }

        return view('admin.group.index', compact('groups', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $groups = new Group();

        $hidden = $request->get('hidden');

        if ($hidden == 0) {
            $name = $request->get('name');
            $name_ar = $request->get('name_ar');
            $role_id = $request->get('role');

            $rules = [
                'name' => 'required',
                'name_ar' => 'required',
                'role' => 'required',
            ];

            $messages = [
                'name.required' => trans('lang.name_required'),
                'name_ar.required' => trans('lang.name_ar_required'),
                'role.required' => trans('lang.role_required'),
            ];

            $validator = \Validator::make([
                'name' => $name,
                'name_ar' => $name_ar,
                'role' => $role_id,
            ], $rules, $messages);

            if ( $validator->fails() ) {
                $all = collect($validator->errors()->getMessages())->map(function($item){
                    return $item[0];
                });
                $strs = [];
                foreach ($all as $value) {
                    $strs[]=  $value;
                }
                return response()->json(['status' => false , 'data' =>$strs]);
            }

            if($name != ''){
                $groups_name_count = $groups->checkGroup(1, $name, $name_ar,$hidden);
                if($groups_name_count > 0){
                    return response()->json(['status' => false , 'data' => trans('lang.group_exists')]);
                }
            }

            DB::beginTransaction();

            try{

                $saved = $groups->addGroup($name, $name_ar, $role_id);

                if(!$saved) {
                    return response()->json(['status' => false , 'data' => "DB"]);
                }

                foreach ( $role_id as $role ) {
                    $role = Role::find($role);

                    if($role){
                        $role_permissions = $role->permissions;

                        foreach($role_permissions as $per){
                            $perm = Permission::find($per->id);
                            $saved->givePermissionTo($perm);
                        }
                    }
                }

                if($role){
                    $role_permissions = $role->permissions;
                    foreach($role_permissions as $per){
                        $perm = Permission::find($per->id);
                        $saved->givePermissionTo($perm);
                    }
                }

                DB::commit();

                return response()->json(['status' => true , 'data' => trans('lang.success')]);

            }catch (\Exception $e){
                DB::rollback();

                return response()->json(['status' => false , 'data' => $e->getMessage()]);
            }
            return response()->json(['status' => false , 'data' => 'Others']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');

        $groups = New Group();

        $group_roles = [];

        $roles = DB::table('group_roles')->where('group_id', $id)->get();

        foreach ( $roles as $role ) {
            $group_roles[] = Role::where('id', $role->role_id)->first();
        }

        $item =  $groups->getGroup($id);
        $item['group_roles'] = $group_roles;
        if($item != ''){
            return response()->json(['status' => true , 'data' => $item]);
        }else{
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $hidden = $request->get('hidden');
        if ( $hidden != 0 ){
            $groups = new Group();
            $item = $groups->getGroup($hidden);

            if ( $item == '' ){
                return response()->json(['status' => false , 'data' => trans('lang.error')]);
            }

            $old_role = $item->role_id;
            $name = $request->get('name');
            $name_ar = $request->get('name_ar');
            $role_id = $request->get('role');

            $rules = [
                'name' => 'required',
                'name_ar' => 'required',
                'role' => 'required',
            ];

            $messages = [
                'name.required' => trans('lang.name_required'),
                'name_ar.required' => trans('lang.name_ar_required'),
                'role.required' => trans('lang.role_required'),
            ];

            $validator = \Validator::make([
                'name' => $name,
                'name_ar' => $name_ar,
                'role' => $role_id,
            ], $rules, $messages);

            if ( $validator->fails() ) {
                $all = collect($validator->errors()->getMessages())->map(function($item){
                    return $item[0];
                });
                $strs = [];
                foreach ($all as $value) {
                    $strs[]=  $value;
                }
                return response()->json(['status' => false , 'data' =>$strs]);
            }

            DB::beginTransaction();

            try{
                $saved = $groups->updateGroup($item, $name, $name_ar, $role_id);

                if(!$saved){
                    return response()->json(['status' => false , 'data' => "Errors"]);
                }

                if ( $old_role != $role_id ) {
                    $user_permissions = User_Permission::where('model_id','=',$item->id)->get();
                    foreach($user_permissions as $per){
                        $perm = Permission::find($per->permission_id);
                        $item->revokePermissionTo($perm);
                    }

                    foreach ( $role_id as $role ) {
                        $role = Role::find($role);

                        if($role){
                            $role_permissions = $role->permissions;

                            foreach($role_permissions as $per){
                                $perm = Permission::find($per->id);

                                $save = Group::latest('id')->first();

                                $save->givePermissionTo($perm->id);
                            }
                        }
                    }
                }

                DB::commit();
                return response()->json(['status' => true , 'data' => trans('lang.success')]);
            }catch (\Exception $e){
                DB::rollback();
                return response()->json(['status' => false , 'data' => $e->getMessage()]);
            }
            return response()->json(['status' => false , 'data' => "Others"]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');

        $groups = new Group();

        $item = $groups->getGroup($id);

        if ( $item != '' ){
            $deleted = $groups->deleteGroup($item);

            if(!$deleted){

                return response()->json(['status' => false , 'data' => trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }
    }
}
