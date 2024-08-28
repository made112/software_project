<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\Admin\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountSettingsRequest extends BaseRequest
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
            'photo' => ['nullable', 'mimes:png,jpg', 'max:2048'],
            'username' => ['required', 'string', 'unique:users,username,' . auth()->id() . ',id'],
            'name' =>  ['required', 'string'],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            'mobile_country' => ['required'],
            'mobile_prefix' => ['required'],
            //'country_code' => ['required'],
            'city_id' => ['required', 'exists:cities,id'],
        ];
    }
}
