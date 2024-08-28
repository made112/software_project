<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\Admin\BaseRequest;
use App\Models\EmailSetting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailSettingsRequest extends BaseRequest
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
            'email_method' => ['required', 'in:' . implode(',', array_column(EmailSetting::EMAIL_METHODS, 'id'))],
            "from_email" => ['required', 'string'],
            "license_expiring_email_title" => ['required', 'string'],
            "support_ending_email_title" => ['required', 'string'],
            "license_expiring_email_template" => ['required'],
            "support_ending_email_template" =>  ['required'],
            "license_expired_notification" =>  ['nullable'],
            "support_end_email_notification" => ['nullable'],
            "update_license_expiring_email_title" =>  ['required', 'string'],
            "update_support_ending_email_title" => ['required', 'string'],
            "update_license_expiring_email_template" =>  ['required'],
            "update_support_ending_email_template" => ['required'],
            "update_license_expired_notification" => ['nullable'],
            "update_support_end_email_notification" => ['nullable'],
        ];
    }
}
