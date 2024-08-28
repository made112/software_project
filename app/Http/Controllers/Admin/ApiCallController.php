<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ApiCall as MyModel;
use DB;

class ApiCallController extends Controller
{
    
    protected $model;
	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

    public function index(Request $request)
    {
        $activation = $this->model->filter($request->all());
        if($request->from){
            $activation = $activation->where('created_at','>=',$request->from);
        }
        if($request->to){
            $activation = $activation->where('created_at','<=',$request->to);
        }
        $activation = $activation->with(['client','product'])
                        ->select('id','client_id','product_id','domain','function','api_key','license_code','ip','status','validation_error',
                        'errors','created_at')->orderBy('id','desc')->paginate(20);
        $data['activation'] = $activation;
        if ($request->ajax()) {
            return view('admin.api_calls.table-data', compact('data'))->render();
        }
        return view('admin.api_calls.index',compact('data'));
    }

    public function view_error(Request $request){
        $id = $request->get('id');
        $obj = MyModel::with(['client','product','version'])->where('id',$id)->first();
        if(!$obj){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        $view = view('admin.api_calls.details_error', compact('obj'))->render();
        return response()->json(['status' => true , 'data' => $view]);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $obj = MyModel::query();
        if(is_array($id)){
            $obj = $obj->whereIn('id',$id);
        }else{
            $obj = $obj->where('id',$id);
        }
        $objs = $obj->get();
        if(!$objs){
            return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }
        
        DB::beginTransaction();
        try {
            
            if($objs){
                foreach($objs as $ob){
                    $deleted = $ob->delete();
                    if(!$deleted){
                        return response()->json(['status' => false , 'data' => trans('lang.error')]);
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
