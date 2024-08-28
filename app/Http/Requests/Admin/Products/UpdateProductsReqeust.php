<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class UpdateProductsReqeust extends BaseRequest
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
            'product_id' => ['required',Rule::unique('products')->ignore($this->id)->whereNull('deleted_at')],
            'name' => 'required',
            'status' => 'required',
            'details' => 'nullable',
            'download_update' => ['required',Rule::in([1, 0])],
            'color' => ['required',Rule::unique('products')->ignore($this->id)->whereNull('deleted_at')],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => trans('lang.product_id_required'),
            'name.required' => trans('lang.name_required'),
            'status.required' => trans('lang.status_required'),
            'product_id.unique' => trans('lang.product_id_exists'),
            'color.required' => trans('lang.color_required'),
            'color.unique' => trans('lang.color_exists'),
        ];
    }
}