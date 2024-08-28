<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cities\StoreCityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Clients;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    public function select(Request $request)
    {
        $country = Country::where('iso2', $request->country_id)->orWhere('id', $request->country_id)->first();

        $cities = City::query()->where('country_id', $country->id)->where('status', 1)->get();

        return response()->json([
            'cities' => $cities,
        ]);
    }

    /**
     * get table of cities
     *
     */
    public function index()
    {
        if(!\Auth::user()->can('cities')){
            abort(403);
        }
        $countries = Country::get();
        $cities = City::indexFilter()->paginate()->appends(request()->all());
        if (request()->ajax()) {
            return response()->json(['status' => true, 'data' => view('admin.cities.table', ['cities' => $cities])->render()]);
        }
        return view('admin.cities.index')
            ->with('countries', $countries)
            ->with('cities', $cities);
    }

    /**
     * update city status
     *
     * @return JsonResponse
     *
     */
    public function updateStatus(): JsonResponse
    {
        if(!\Auth::user()->can('update_status_cities')){
            abort(403);
        }
        $city = City::find(request()->input('id'));

        if (!$city) {
            return response()->json(['status' => false, 'data' => __('lang.city') . ' ' . __('lang.not_found')]);
        }

        $city->update([
            'status' => !$city->status
        ]);
        return response()->json(['status' => true, 'data' => __('lang.success'), 'city' => $city]);
    }

    /**
     * show create new city form
     *
     * @return View
     *
     */
    public function create(): View
    {
        if(!\Auth::user()->can('add_cities')){
            abort(403);
        }
        $countries = Country::get();

        return view('admin.cities.create')->with('countries', $countries);
    }

    public function store(StoreCityRequest $request)
    {
        if(!\Auth::user()->can('add_cities')){
            abort(403);
        }
        $data = $request->validated();
        $data['status'] = $request->has('status');

        $city = City::create($data);

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }


    /**
     * show create new city form
     *
     * @return View
     *
     */
    public function edit(City $city): View
    {
        if(!\Auth::user()->can('update_cities')){
            abort(403);
        }
        $countries = Country::get();

        return view('admin.cities.edit')
            ->with('city', $city)->with('countries', $countries);
    }

    public function update(City $city, StoreCityRequest $request)
    {
        if(!\Auth::user()->can('update_cities')){
            abort(403);
        }
        $data = $request->validated();
        $data['status'] = $request->has('status');

        $city->update($data);

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $obj = City::find($id);
        if(!$obj){
            return response()->json(['status' => false, 'data' => __('lang.city') . ' ' . __('lang.not_found')]);
        }
        $client = Clients::where('city_id',$id)->first();
        if($client){
            return response()->json(['status' => false, 'data' => __('lang.city_cannot_delete')]);
        }
        $deleted = $obj->delete();
        if(!$deleted){
            return response()->json(['status' => false, 'data' => __('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }
}
