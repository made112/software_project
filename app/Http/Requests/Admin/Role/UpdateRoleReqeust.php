<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\BaseRequest;
use App\Models\ProductPackage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleReqeust extends BaseRequest
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
            'name' => ['required'],
        ];
    }
}
