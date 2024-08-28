<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function select()
    {
        $countries = Country::query();

        if (request()->has('country_name')) {
            $name = request()->input('country_name');
            $countries->where('name_ar', 'like', "%{$name}%")->orWhere('name_en', 'like', "%{$name}%");
        }
        $countries = $countries->take(request()->input('limit', 6))->get();
        return json_encode($countries);
    }

    /**
     * get table of countries
     *
     * @return View
     *
     */
    public function index()
    {
        if(!\Auth::user()->can('countries')){
            abort(403);
        }
        $countries = Country::query();
        if (!is_null(request()->input('status'))) {
            $status = request()->input('status');

            $countries = $countries->where('status', $status);
        }


        if (!is_null(request()->input('name'))) {
            $name = request()->input('name');

            $countries = $countries->where(function ($query) use ($name) {
                return $query->where('name_en', 'like', "%{$name}%")->orWhere('name_ar', 'like', "%{$name}%");
            });
        }

        $countries = $countries->paginate()->appends(request()->all());

        if (request()->ajax()) {
            return response()->json(['status' => true, 'data' => view('admin.countries.table', ['countries' => $countries])->render()]);
        }
        return view('admin.countries.index')
            ->with('countries', $countries);
    }


    /**
     * update country status
     *
     * @return JsonResponse
     *
     */
    public function updateStatus(): JsonResponse
    {
        if(!\Auth::user()->can('update_status_countries')){
            abort(403);
        }
        $country = Country::find(request()->input('id'));

        if (!$country) {
            return response()->json(['status' => false, 'data' => __('lang.country') . ' ' . __('lang.not_found')]);
        }

        $country->update([
            'status' => !$country->status
        ]);

        $cities = City::where('country_id', $country->id)->get();

        foreach ( $cities as $city ) {
            $city->update([
                'status' => 0,
            ]);
        }

        return response()->json(['status' => true, 'data' => __('lang.success'), 'country' => $country]);
    }
}
