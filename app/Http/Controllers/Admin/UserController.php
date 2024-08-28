<?php


namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\User as MyModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use Spatie\Permission\Models\Role;
use DB;
use App\Models\Country;

class UserController extends AdminController
{

    public function __construct()
    {
        // parent::__construct();
    }

    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $id =\Auth::user()->id;
        $name  = $request->get('name');
        $status  = $request->get('status');
        $users = New MyModel();
        $data['users'] = $users->getUsers($name,$status);
        $data['roles'] = Role::get(['id','name']);
        $lang = \App::getLocale();
        if ($request->ajax()) {
            return view('admin.users.table-data', compact('data'))->render();
        }
        return view('admin.users.index',compact('data'));
    }
    /***********************************************************************************************************************/
    public function add(Request $request){

        $users = New MyModel();
        $hidden = $request->get('hidden');
        if($hidden == 0){
            $name = $request->get('user_name');
            $fullname = $request->get('name_profile');
            $password = $request->get('password');
            $email = $request->get('email');
            $type = $request->get('type');
            if(isset($request['activeValue'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name' => 'required',
                'password' => 'required',
                'fullname' => 'required',
                'email' => 'required',
            ];

            $messages = [
                'name.required' => trans('lang.name_required'),
                'password.required' => trans('lang.password_required'),
                'fullname.required' => trans('lang.name_required'),
                'email.required' => trans('lang.email_required'),
            ];



            $validator = \Validator::make([
                'name' => $name,
                'password' => $password,
                'email' => $email,
                'fullname' => $fullname,
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



            if($name != ''){
                $users_name_count = $users->checkUser(1,$name,'');
                if($users_name_count > 0){
                    return response()->json(['status' => false , 'data' => trans('lang.username_exists')]);
                }

            }

            DB::beginTransaction();
            try {

            $saved = $users->addUser($name,$password,$status,$fullname,$email,$type);
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans('lang.error')]);
            }

            $role = Role::find($type);
            if($role){
                $role_permissions = $role->permissions;
                foreach($role_permissions as $per){
                    $perm = Permission::find($per->id);
                    $saved->givePermissionTo($perm);
                }
            }

            DB::commit();
            return response()->json(['status' => true , 'data' => trans('lang.success')]);

            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }else{
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }

    }
    /***********************************************************************************************************************/
    public function edit(Request $request){
        $id = $request->get('id');
        $users = New MyModel();
        $item =  $users->getUser($id);
        if($item != ''){
            return response()->json(['status' => true , 'data' => $item]);
        }else{
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
    }
    /***********************************************************************************************************************/
    public function UpdateStats(Request $request){
        $id = $request->get('id');
        $users = New MyModel();
        $item =  $users->getUser($id);
        if($item != ''){
            $saved = $users->UpdateStatus($item);
            if(!$saved){
                return response()->json(['status' => false , 'data' => trans('lang.error')]);
            }
            return response()->json(['status' => true , 'data' => 'تم تعديل الحالة']);
        }else{
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
    }

/***********************************************************************************************************************/
    public function update(Request $request){
        $hidden = $request->get('hidden');
        if($hidden != 0){
            $users = New MyModel();
            $item =  $users->getUser($hidden);
            if($item == ''){
                return response()->json(['status' => false , 'data' => trans('lang.error')]);
            }

            $old_role = $item->role;
            $name = $request->get('user_name');
            $fullname = $request->get('name_profile');
            $email = $request->get('email');
            $password = $request->get('password');
            $type = $request->get('type');
            if(isset($request['activeValue'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name' => 'required',
                'fullname' => 'required',
                'email' => 'required',
            ];

            $messages = [
                'name.required' => trans('lang.name_required'),
                'fullname.required' => trans('lang.name_required'),
                'email.required' => trans('lang.email_required'),
            ];

            $validator = \Validator::make([
                'name' => $name,
                'password' => $password,
                'email' => $email,
                'fullname' => $fullname,
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

            if($name != ''){
                $users_name_count = $users->checkUser(2,$name,$hidden);
                if($users_name_count > 0){
                    return response()->json(['status' => false , 'data' => trans('lang.username_exists')]);
                }
            }


            DB::beginTransaction();
            try {

                $saved = $users->updateUser($item,$name,$password,$status,$fullname,$email,$type);
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans('lang.error')]);
                }

                if($old_role != $type){

                    $user_permissions = User_Permission::where('model_id','=',$item->id)->get();
                    foreach($user_permissions as $per){
                        $perm = Permission::find($per->permission_id);
                        $item->revokePermissionTo($perm);
                    }

                    $role = Role::find($type);
                    if($role){
                        $role_permissions = $role->permissions;
                        foreach($role_permissions as $per){
                            $perm = Permission::find($per->id);
                            $item->givePermissionTo($perm);
                        }
                    }
                }

                DB::commit();
                return response()->json(['status' => true , 'data' => trans('lang.success')]);

            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }

    }

/****************************************************************************************************************************************** */

    public function delete(Request $request){

        $id = $request->get('id');

        if($id == 1){

            return response()->json(['status' => false , 'data' => trans('lang.delete_admin')]);

        }

        $users = New MyModel();

        $item =  $users->getUser($id);

        if($item != ''){

            $deleted = $users->deleteUser($item);

            if(!$deleted){

                return response()->json(['status' => false , 'data' => trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }



    }

/****************************************************************************************************************************************** */

  public function changepassword(Request $request){



     $hidden = $request->get('hidden');

     $password = $request->get('password');

     $confirmation_password = $request->get('confirmation_password');



    if($password == '' or $confirmation_password == ''){

    return response()->json(['status' => false , 'data' => trans('lang.required')]);

    }



    $users = New MyModel();

    $item =  $users->getUser($hidden);

    if($item != ''){

        if($password === $confirmation_password){

            $saved = $users->changePassword($item,$password);

            $saved = $item->save();

            if(!$saved){

                return response()->json(['status' => false , 'data' => trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.password_changed')]);

        }else{

            return response()->json(['status' => false , 'data' => trans('lang.password_not_match')]);

        }

    }else{

        return response()->json(['status' => false , 'data' => trans('lang.error')]);

    }



  }

/**************************************************************************************/

public function permission(Request $request){



    $hidden = $request->get('hidden');

    $permissions = $request->get('permissions');

    $item = MyModel::find($hidden);

        if($item != ''){

            $user_permissions = User_Permission::where('model_id','=',$item->id)->get();

           foreach($user_permissions as $per){
            $perm = Permission::find($per->permission_id);
            $item->revokePermissionTo($perm);

           }



            if($permissions){

                foreach($permissions as $permission){

                        $perm = Permission::find($permission);

                        $item->givePermissionTo($perm);

                }

            }

           return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }



}

/************************************************************************************************************************************ */



public function getpermission(){
    $lang = \App::getLocale();
   return $data['permissions'] = Permission::orderBy('group_id','asc')->orderBy('id','asc')->get(['id',"name_$lang as name",'name as name_en','group_id','group']);

}



public function userpermission(Request $request){



    $id = $request->get('id');

    $user_permissions = User_Permission::where('model_id','=',$id)->get();

    $permissions = self::getpermission();

    $permissions = $permissions->groupBY('group_id');

    $user_per ='';

    $per_group = 0;

    $checked ='';

    $i = 0;

    $z = 0;

    $margin_top = 0;

    $view = view('admin.users.sub.permission', compact(['permissions','user_permissions']))->render();

    return response()->json(['data'=>$view]);



}



}
