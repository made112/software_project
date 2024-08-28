<?php

namespace App\Http\Requests\Admin\Clients;

use App\Http\Requests\Admin\BaseRequest;
use App\Models\Country;
use App\Rules\CityRelatedToCountryRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientUserReqest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'products' => ['required'],
            'products.*' => ['required', 'exists:products,id'],
            'email' => ['required', 'email'],
            'phone_number' => ['digits:9','required', 'unique:client_users'],
            'job_title' => ['required'],
            'status' => ['required'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg'],
            'country_id' => ['required', 'exists:countries,id'],
            'country_code' => ['required', 'exists:countries,country_code'],
            'city_id' => ['required', 'exists:cities,id', new CityRelatedToCountryRule(Country::find($this->input('country_id')))],
            'gender' => ['required'],
        ];
    }
}
