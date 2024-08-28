<?php

namespace App\Http\Requests\Admin\Products;

use App\Http\Requests\Admin\BaseRequest;
use App\Models\ProductPackage;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductPackageRequest extends BaseRequest
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
            'name' => ['required', 'string'],
            'description' => ['required'],
            'type' => ['required', 'in:' . implode(',', array_column(ProductPackage::TYPES, 'id'))],

            // Start Duration
            'duration_free' => ['required_if:type,' . ProductPackage::TYPES[0]['id']],
            'duration_paid' =>  ['required_if:type,' . ProductPackage::TYPES[1]['id']],
            // End Duration


            'days' => ['required_if:type,' . ProductPackage::TYPES[0]['id']],
            'time' => ['required_if:type,' . ProductPackage::TYPES[1]['id']],

            'price' => ['required_if:type,' . ProductPackage::TYPES[1]['id']],

            'remotely_price' => ['required_if:support_type_paid,'. ProductPackage::TYPES[1]['id']],
            'prim_price' => ['required_if:prime_support_type_paid,'. ProductPackage::TYPES[1]['id']],

            // Start Support Type
            'support_type_free' => ['nullable'], // 1
            'support_type_paid' => ['nullable'], // 2
            // End Support Type


            'prime_support_type_paid' => ['nullable', 'in:1,2'], // 2
            'prime_support_type_free' => ['nullable', 'in:1,2'], // 1

        ];
    }
}
