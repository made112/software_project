<?php

namespace App\Http\Requests\ApiCall\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class LastVersionRequest extends BaseRequest
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
            'product_id' =>  ['required','exists:products,id'],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => trans('lang.product_id_required'),
            'product_id.exists' => trans('lang.product_id_exists'),
        ];
    }
}