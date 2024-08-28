<?php

namespace App\Http\Requests\Admin\Notifications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class UpdateNotificationsRequest extends BaseRequest
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
            'notification_type' => 'required',
            'date' => 'required_if:status,2|after_or_equal:'.date('Y-m-d H:i'),
            'product_id' => 'required',
            'notification_title'=> 'required',
            'notification_content' => 'required',
            'channel_id' => 'required',
            'status' => 'required',
            'client_id' => 'nullable',
            'client_id.*' => 'nullable',
            'is_send' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'notification_type.required' => trans('lang.notification_type_required'),
            'date.required_if' => trans('lang.date_required'),
            'date.after_or_equal' => trans('lang.date_after_or_equal_now'),
            'product_id.required' => trans('lang.product_id_required'),
            'notification_title.required'=> trans('lang.notification_title_required'),
            'notification_content.required' => trans('lang.notification_content_required'),
            'channel_id.required' => trans('lang.channel_id_required'),
            'status.required' => trans('lang.status_required'),
            // 'client_id.required' => trans('lang.clients_required'),
            // 'client_id.*.required' => trans('lang.clients_required'),
        ];
    }
}