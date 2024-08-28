<?php

namespace App\Http\Requests\Admin\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;
use App\Rules\IpRule;
use App\Rules\UrlRule;

class UpdateLicenseRequest extends BaseRequest
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
//            'client_id' => 'required',
//            'product_id' => 'required',
//            'license_code' => ['required',Rule::unique('licenses')->ignore($this->id)->whereNull('deleted_at')],
//            'use_limit'=> 'nullable',
//            'parallel_use_limit' => 'nullable',
//            'date' => 'nullable|after_or_equal:'.date('Y-m-d'),
//            'days' => 'nullable',
//            'support_type' => 'required',
//            'type' => 'required',
//            'domains' => ['nullable'],
//            'ip' => ['nullable',new IpRule],
           'invoice_no' => ['nullable',Rule::unique('licenses')->ignore($this->id)->whereNull('deleted_at')],
//            'grace_end_days' => 'nullable',
//            'machine_id' => 'nullable',
//            'file' => 'nullable',
//            'comments' => 'nullable',
//            'block' => ['required',Rule::in([1, 0])],
//            'price' => 'nullable|numeric|min:0',
//            'payment_type' => 'required',
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
            'file.mimes' => trans('lang.file_format').' doc,txt,pdf,xls',
            'price.min' => trans('lang.price_greater_zero'),
            'payment_type.required' => trans('lang.payment_type_required'),
            'invoice_no.unique'=> trans('lang.invoice_no_exists'),
        ];
    }
}








