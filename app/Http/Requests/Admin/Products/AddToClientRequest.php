<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class AddToClientRequest extends BaseRequest
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
            'product_id' =>  ['required',Rule::unique('clients_products')->whereNull('deleted_at')->where('client_id',$this->client_id)],
            'client_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => trans('lang.product_id_required'),
        ];
    }
}