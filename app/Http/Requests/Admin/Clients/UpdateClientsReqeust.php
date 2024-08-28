<?php

namespace App\Http\Requests\Admin\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;
use App\Models\Country;
use App\Rules\CityRelatedToCountryRule;

class UpdateClientsReqeust extends BaseRequest
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
            'client_id' => ['required', Rule::unique('clients')->ignore($this->id)->whereNull('deleted_at')],
            'name' => 'required',
            'email' => ['required', Rule::unique('clients')->ignore($this->id)->whereNull('deleted_at')],
            'status' => ['required', Rule::in([1, 2])],
            'phone_number' => ['digits:9','required', Rule::unique('clients')->ignore($this->id)->whereNull('deleted_at')],
            'country_code' => 'required',
            'country_id' => 'required',
            'city_id' => ['required', 'exists:cities,id', new CityRelatedToCountryRule(Country::find($this->input('country_id')))],
            'project_manager.*' => 'required',
            'twitter_link' => ['nullable', 'url'],
            'website_link' => ['nullable', 'url'],
            'image' => ['nullable','mimes:png,jpg,jpeg,svg']
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
            'project_manager.*.required' => trans('lang.project_manager_required'),
            'image.mimes' => trans('lang.image_format').' png,jpg,jpeg,svg',
        ];
    }
}
