<?php

namespace App\Http\Requests\Admin\Versions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\BaseRequest;

class UpdateVersionsRequest extends BaseRequest
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
            'product_id' => ['required'],
            'name' => 'required',
            'date' => 'required',
            'notification_summry' => 'required',
            'change_log' => 'required',
            'publish_version' => ['required',Rule::in([1, 2])],
            'main_files' => 'nullable|mimes:zip',
            'block' => ['required',Rule::in([1, 0])],
            'branch' => ['required']
            // 'sql_files' => 'nullable|mimes:sql',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => trans('lang.product_id_required'),
            'name.required' => trans('lang.name_required'),
            'date.required' => trans('lang.date_required'),
            'notification_summry.required' => trans('lang.notification_summry_required'),
            'change_log.required' => trans('lang.change_log_required'),
            'publish_version.required' => trans('lang.publish_version_required'),
            'main_files.mimes' => trans('lang.files_format').' Zip',
            // 'sql_files.mimes' => trans('lang.files_format').' Sql',
        ];
    }
}
