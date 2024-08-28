<?php

namespace App\Http\Requests\Admin\Cities;

use App\Http\Requests\Admin\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends BaseRequest
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
            'name_en' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'country_id' => ['required', 'exists:countries,id'],
            'status' => ['nullable']
        ];
    }
}
