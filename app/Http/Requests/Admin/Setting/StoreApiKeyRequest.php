<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class StoreApiKeyRequest extends BaseRequest
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
            'api_key' => ['required',Rule::unique('api_key')->whereNull('deleted_at')],
            'api_key_type' => 'required',
            'special_permission' => ['required',Rule::in([1, 0])],
        ];
    }
    
    
    public function messages()
    {
        return [
            'api_key.required' => trans('lang.api_key_required'),
            'api_key.unique' => trans('lang.api_key_exists'),
            'api_key_type.required' => trans('lang.api_key_type_required'),
            'special_permission.required' => trans('lang.special_permission_required'),
        ];
    }
}