<?php

namespace App\Http\Controllers\Admin;

use App\Models\StaticPage as MyModel;
use App\Models\Partners;
use App\Models\System_Constants;
use Illuminate\Http\Request;
use Lang;

class StaticPageController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        // $this->middleware(['permission:static_page|view_page|edit_page|delete_page|add_page|status_page']);
    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('view_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }

        $lang = \App::getLocale();
        $data['system'] = array(['value2'=>'en','name'=>trans('lang.english')]);
        $data['static'] = MyModel::orderBy('id','desc')->where('slug','!=','splash')->select('id','slug','photo','status',"title","details")->get();
        if ($request->ajax()) {
            return view('admin.static_page.table-data', compact('data'))->render();
        }
        return view('admin.static_page.index',compact('data'));
    }
  /***********************************************************************************************************************/
    public function add(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('add_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $hidden = $request->get('hidden');
        if($hidden == 0){
            $user_id = \Auth::user()->id;
            $title_ar = $request->get('title_ar');
            $details_ar = $request->get('details_ar');
            $title_en = $request->get('title_en');
            $details_en = $request->get('details_en');
            $slug = $request->get('slug');
            if(isset($request['activeValue'])){
                $status = 1;
            }else{
                $status = 0;
            }
            $file = $request->file('image');

            $rules = [
                'title_en' => 'required',
                'details_en' => 'required',
                // 'title_en' => 'required',
                // 'details_en' => 'required',
                'slug' => 'required', 
                'file' => 'nullable|mimes:png,jpeg,jpg,mp4,svg',
            ];

            $validator = \Validator::make([
                'title_en' => $title_en,
                'details_en' => $details_en,
                'slug' => $slug,
                'file' => $file,
            ],
                $rules

            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            if($slug != ''){
                if(preg_match('/[^A-Za-z0-9-_]/', $slug)){
                    return response()->json(['status' => false , 'data' => trans("lang.slug_error")]);
                }
                $count = MyModel::where('slug',$slug)->count();
                if($count > 0){
                    return response()->json(['status' => false , 'data' => trans("lang.slug_used")]);
                }
            }
           

            $pic = '';
            if ($request->hasFile('image') && $file->isValid())
            {
                $pic = 'pic_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $pic);
            }

            // $title['title_ar'] = $title_ar;
            $title['title_en'] = $title_en;

            // $details['details_ar'] = $details_ar;
            $details['details_en'] = $details_en;

            $item = new MyModel();
            $item->user_id = $user_id;
            $item->title = $title_en;//json_encode($title, true);
            $item->details = $details_en;//json_encode($details, true);
            if($item->slug == 0){
                $item->slug = $slug;
            }
            $item->status = $status;
            if($pic){
                $item->photo = $pic;
            }
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }


    }
/***********************************************************************************************************************/
    public function edit(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('edit_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
            $item = MyModel::where('id',$id)->first(['id','title','details','slug','status','photo','user_id']);
            if($item != ''){
                return response()->json(['status' => true , 'data' => $item]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
    }

    /***********************************************************************************************************************/

    public function UpdateStats(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('status_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
            if($item != ''){
                if($item->status == 0){
                    $item->status = 1;
                }else{
                    $item->status = 0;
                }
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
    }
/***********************************************************************************************************************/
    public function update(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('edit_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $hidden = $request->get('hidden');

        if($hidden != 0){
            $user_id = \Auth::user()->id;
            $title_ar = $request->get('title_ar');
            $details_ar = $request->get('details_ar');
            $title_en = $request->get('title_en');
            $details_en = $request->get('details_en');
            $slug = $request->get('slug');
            $file = $request->file('image');
            if(isset($request['activeValue'])){
                $status = 1;
            }else{
                $status = 0;
            }
            $video = $request->file('video');

            $rules = [
                'title_en' => 'required',
                'details_en' => 'required',
                'slug' => 'required',
                'file' => 'nullable|mimes:png,jpeg,jpg,mp4,svg',
            ];

            $validator = \Validator::make([
                'title_en' => $title_en,
                'details_en' => $details_en,
                'slug' => $slug,
                'file' => $file,
            ],
                $rules

            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            if($slug != ''){
                if(preg_match('/[^A-Za-z0-9_-]/', $slug)){
                    return response()->json(['status' => false , 'data' => trans("lang.slug_error")]);
                }
                $count = MyModel::where('slug',$slug)->where('id','!=',$hidden)->count();

                if($count > 0){
                    return response()->json(['status' => false , 'data' => trans("lang.slug_used")]);
                }
            }

            $pic = '';
            if ($request->hasFile('image') && $file->isValid())
            {
                $pic = 'pic_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $pic);
            }

            // $title['title_ar'] = $title_ar;
            $title['title_en'] = $title_en;

            // $details['details_ar'] = $details_ar;
            $details['details_en'] = $details_en;
            

            $item = MyModel::find($hidden);
            if($item != ''){
                $item->user_id = $user_id;
                $item->title = $title_en;//json_encode($title, true);
                $item->details = $details_en;//json_encode($details, true);
                $item->status = $status;
                if($item->slug == 0){
                    $item->slug = $slug;
                }
                if($pic != ''){
                    $item->photo = $pic;
                }
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

        }
    }

    public function delete(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('delete_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
        if($item != ''){
            if($item->flag == 1){
                return response()->json(['status' => false , 'data' => trans("lang.can_delete")]);
            }
            $deleted = $item->delete();
            if(!$deleted){
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }

    }
}
