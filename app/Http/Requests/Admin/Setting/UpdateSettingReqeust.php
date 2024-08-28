<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class UpdateSettingReqeust extends BaseRequest
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
            'name' => 'nullable',
            'email' => 'required',
            'mobile' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'license_code' => 'required',
            'time_zone' => 'required',
            'blacklist_domain_attempts' => 'required',
            'blacklist_ip_attempts' => 'required',
            'activation_attempts' => ['required', Rule::in([1, 0])],
            'download_attempts' => ['required', Rule::in([1, 0])],
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'linkedin' => 'nullable',
            'freshdesk_api_key' => 'nullable',
            'remain_days_license' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'license_code.required' => trans('lang.license_code_required'),
            'time_zone.required' => trans('lang.time_zone_required'),
            'blacklist_domain_attempts.required' => trans('lang.blacklist_domain_attempts_required'),
            'blacklist_ip_attempts.required' => trans('lang.blacklist_ip_attempts_required'),
            'activation_attempts.required' => trans('lang.activation_attempts_required'),
            'download_attempts.required' => trans('lang.download_attempts_attempts'),
            'remain_days_license.required' => trans('lang.remain_days_license_required')
        ];
    }
}
