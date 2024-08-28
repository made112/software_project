<?php

namespace App\Http\Requests\Admin\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class EmailRequest extends BaseRequest
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
            'to' => 'required',
            'email_subject' => 'required',
            'message' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'to.required' => trans('lang.email_required'),
            'email_subject.required' => trans('lang.email_subject_required'),
            'message.required' => trans('lang.message_required'),
        ];
    }
}








