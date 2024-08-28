<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;
use App\Http\Requests\Admin\Activities\DeleteActivitiesRequest;

class ActivityLogController extends Controller
{
    /**
     * show activites page
     *
     * @return View
     *
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $activities = Activity::with('causer')->orderBy('id', 'desc');
        if($name){
            $activities = $activities->where(function ($query) use  ($name) {
                $query->where('description', 'like', "%{$name}%")->orWhereHas('causer', function ($query) use ($name) {
                    $query->where('name', 'like', "%{$name}%")->orWhere('username', 'like', "%{$name}%");
                });
            });
        }
        $activities = $activities->paginate(20);
        // return view('admin.activiy_logs.index')
            // ->with('activities', $activities);
        if ($request->ajax()) {
            return view('admin.activiy_logs.table', compact('activities'))->render();
        }
        return view('admin.activiy_logs.index',compact('activities'));
    }

    /**
     * delete activites from database
     *
     * @param DeleteActivitiesRequest $request
     *
     * @return JsonResponse
     *
     */
    public function destroy(DeleteActivitiesRequest $request): JsonResponse
    {
        Activity::destroy($request->input('activities'));

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    /**
     * get table of activities with filter by causer and desription
     *
     * @return JsonResponse
     *
     */
    public function getTable(): JsonResponse
    {
        $activities = Activity::orderBy('id', 'desc')->when(request()->input('name', false), function ($query, $name) {
            $query->where('description', 'like', "%{$name}%")->orWhereHas('causer', function ($query) use ($name) {
                $query->where('name', 'like', "%{$name}%")->orWhere('username', 'like', "%{$name}%");
            });
        })->paginate(20);

        return response()->json([
            'status' => true,
            'data' => view('admin.activiy_logs.table')->with('activities', $activities)->render()
        ]);
    }
}
