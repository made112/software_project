<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupRole;
use App\Models\Tag;
use App\Models\TicketPriority;
use App\Models\TicketType;
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

class TicketPrriotaryController extends Controller
{

    protected $model;

    public function __construct(TicketPriority $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Request $request)
    {

        $tags = $this->model;


        $tags = $tags->select('id', 'name_en', 'name_ar','color')->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.priotary.table-data', compact('tags'))->render();
        }

        return view('admin.priotary.index', compact('tags'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $tags = new TicketPriority();

        $hidden = $request->get('hidden');

        if ($hidden == 0) {
            $name = $request->get('name');
            $color = $request->get('color');
            $name_ar = $request->get('name_ar');
            $created_by = auth()->user()->id;

            $rules = [
                'name_en' => 'required',
                'name_ar' => 'required',
                'color'=>'nullable'
            ];

            $messages = [
                'name_en.required' => trans('lang.name_required'),
                'name_ar.required' => trans('lang.name_ar_required'),
            ];

            $validator = \Validator::make([
                'name_en' => $name,
                'name_ar' => $name_ar,
            ], $rules, $messages);

            if ($validator->fails()) {
                $all = collect($validator->errors()->getMessages())->map(function ($item) {
                    return $item[0];
                });
                $strs = [];
                foreach ($all as $value) {
                    $strs[] = $value;
                }
                return response()->json(['status' => false, 'data' => $strs]);
            }


            DB::beginTransaction();

            try {

                $tags->name_ar = $name_ar;
                $tags->name_en = $name;
                $tags->color = $color;
                $tags->created_by = $created_by;

                $tags->save();

                DB::commit();

                return response()->json(['status' => true, 'data' => trans('lang.success')]);

            } catch (\Exception $e) {
                DB::rollback();

                return response()->json(['status' => false, 'data' => $e->getMessage()]);
            }
            return response()->json(['status' => false, 'data' => 'Others']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $id = $request->get('id');
        $tags = new TicketPriority();
        $tags = $tags->where('id', $id)->firstorfail();

        if ($tags != '') {
            return response()->json(['status' => true, 'data' => $tags]);
        } else {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $hidden = $request->get('hidden');
        if ( $hidden != 0 ){
            $tag = new TicketPriority();
            $item = $tag->getPriority($hidden);

            if ( $item == '' ){
                return response()->json(['status' => false , 'data' => trans('lang.error')]);
            }

            $name = $request->get('name');
            $name_ar = $request->get('name_ar');
            $color = $request->get('color');

            $rules = [
                'name_en' => 'required',
                'name_ar' => 'required',
            ];

            $messages = [
                'name_en.required' => trans('lang.name_required'),
                'name_ar.required' => trans('lang.name_ar_required'),
            ];

            $validator = \Validator::make([
                'name_en' => $name,
                'name_ar' => $name_ar,
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
             $item->update([
                    'name_en'=>$name,
                    'name_ar'=>$name_ar,
                     'color'=>$color

                ]);




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

        $tag = new TicketPriority();

        $item = $tag->where('id',$id)->first();


        if ( $item != '' ){
            $deleted = $item->delete();

            if(!$deleted){

                return response()->json(['status' => false , 'data' => trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }
    }
}
