<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TicketSystemRequest extends FormRequest
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
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:250'],
            'email' => ['required', 'exists:clients,email'],
            'priority' => ['required', 'in:1,2,3,4'],
            'status' => ['required', 'in:1,2,3,4,5,6'],
            'type' => ['required', 'in:1,2'],
            'client-id' => ['required'],
//            'group_id' => ['required', 'exists:groups,id'],
//            'ip' => ['nullable'],
        ];
    }
}
