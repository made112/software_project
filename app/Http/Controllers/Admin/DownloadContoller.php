<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ApiCall as MyModel;

class DownloadContoller extends Controller
{
    
    protected $model;
	public function __construct(MyModel $model)
	{
		$this->model = $model;
	}

    public function index(Request $request)
    {
        $downloads = $this->model->filter($request->all());
        if($request->from){
            $downloads = $downloads->where('created_at','>=',$request->from);
        }
        if($request->to){
            $downloads = $downloads->where('created_at','<=',$request->to);
        }
        $downloads = $downloads->with(['client','product','version'])->whereIn('function',[MyModel::UpdateDownloads])
                        ->select('id','client_id','version_id','product_id','download_url','domain','function','api_key','license_code','ip','status','validation_error',
                        'errors','created_at')->orderBy('id','desc')->paginate(20);
        $data['downloads'] = $downloads;
        if ($request->ajax()) {
            return view('admin.downloads.table-data', compact('data'))->render();
        }
        return view('admin.downloads.index',compact('data'));
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
