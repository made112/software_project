<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Activities\DeleteActivitiesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ApiCall as MyModel;

class ActivationController extends Controller
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
        if($request->function_filter){
            $activation = $activation->where('function',$request->function_filter);
        }else{
            $activation = $activation->whereIn('function',[MyModel::ActivateLicense,MyModel::DeactivateLicense]);
        }
        $activation = $activation->with(['client','product'])
                        ->select('id','client_id','product_id','domain','function','api_key','license_code','ip','status','validation_error',
                        'errors','created_at')->orderBy('id','desc')->paginate(20);
        $data['activation'] = $activation;
        if ($request->ajax()) {
            return view('admin.activation.table-data', compact('data'))->render();
        }
        return view('admin.activation.index',compact('data'));
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

}
