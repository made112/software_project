<?php

namespace App\Http\Requests\Admin\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\IpRule;
use App\Rules\UrlRule;
use App\Http\Requests\Admin\BaseRequest;

class StoreLicenseRequest extends BaseRequest
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
            'client_id' => 'required',
            'product_id' => 'required',
            'license_code' => ['required',Rule::unique('licenses')->whereNull('deleted_at')],
            'use_limit'=> 'nullable',
            'parallel_use_limit' => 'nullable',
            'date' => 'nullable|after_or_equal:'.date('Y-m-d'),
            'days' => 'nullable',
            'type' => 'required',
            'domains' => ['nullable'],
            'ip' => ['nullable',new IpRule],
            'invoice_no' => ['nullable',Rule::unique('licenses')->whereNull('deleted_at')],
            'machine_id' => 'nullable',
            'grace_end_days' => 'nullable',
            'file' => 'required_if:type,2',
            'product_package_id' => 'required',
            'package_support_type' => 'required',
            'comments' => 'nullable',
            'block' => ['required',Rule::in([1, 0])],
            'price' => 'nullable|numeric|min:0',
            'payment_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => trans('lang.client_required'),
            'product_id.required' => trans('lang.product_required'),
            'date.after_or_equal' => trans('lang.date_after_or_equal_now'),
            'license_code.required' => trans('lang.license_code_required'),
            'license_code.unique'=> trans('lang.license_code_exists'),
            'type.required' => trans('lang.license_type_required'),
            'support_type.required' => trans('lang.support_type_required'),
            'file.required_if' => trans('lang.file_required'),
            'file.mimes' => trans('lang.file_format').' txt',
            'price.min' => trans('lang.price_greater_zero'),
            'invoice_no.unique'=> trans('lang.invoice_no_exists'),
            'payment_type.required' => trans('lang.payment_type_required'),
        ];
    }
}








