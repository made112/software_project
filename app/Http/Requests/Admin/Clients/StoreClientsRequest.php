<?php

namespace App\Http\Requests\Admin\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;
use App\Models\City;
use App\Models\Country;
use App\Rules\CityRelatedToCountryRule;

class StoreClientsRequest extends BaseRequest
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
            'client_id' => ['required', Rule::unique('clients')->whereNull('deleted_at')],
            'name' => 'required',
            'email' => ['required', Rule::unique('clients', 'email')],
            'status' => ['required', Rule::in([1, 2])],
            'phone_number' => ['required', 'unique:clients,phone_number'],
            'country_code' => 'required',
            'country_id' => 'required',
            'city_id' => ['required', 'exists:cities,id', new CityRelatedToCountryRule(Country::find($this->input('country_id')))],
            'project_manager' => 'required',
            'project_manager.*' => 'required',
            'image' => ['nullable','mimes:png,jpg,jpeg,svg'],
            'twitter_link' => ['nullable', 'url'],
            'website_link' => ['nullable', 'url'],
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => trans('lang.client_id_required'),
            'client_id.unique' => trans('lang.client_id_exists'),
            'name.required' => trans('lang.name_required'),
            'email.required' => trans('lang.email_required'),
            'email.unique' => trans('lang.email_exists'),
            'status.required' => trans('lang.status_required'),
            'country_code.required' => trans('lang.country_code_required'),
            'country_id.required' => trans('lang.country_id_required'),
            'phone_number.required' => trans('lang.phone_number_required'),
            'phone_number.digits' => trans('lang.phone_number_digits'),
            'project_manager.required' => trans('lang.project_manager_required'),
            'project_manager.*.required' => trans('lang.project_manager_required'),
            'image.mimes' => trans('lang.image_format').' png,jpg,jpeg,svg',
        ];
    }
}
