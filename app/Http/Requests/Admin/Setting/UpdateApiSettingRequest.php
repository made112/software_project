<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class UpdateApiSettingRequest extends BaseRequest
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
            'api_request_rate_limiting_methond' => 'nullable',
            'api_request_rate_limit' => 'nullable|numeric|min:0|not_in:0',
            'api_blacklisted_domain' => 'nullable',
            'api_blacklisted_ips' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'api_request_rate_limiting_methond.required' => trans('lang.api_request_rate_limiting_methond_required'),
        ];
    }
}