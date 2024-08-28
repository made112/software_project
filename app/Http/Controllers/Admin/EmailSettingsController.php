<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateEmailSettingsRequest;
use App\Models\EmailSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmailSettingsController extends Controller
{

    /**
     * show email settings page
     *
     * @return View
     *
     */
    public function index(): View
    {
        $emailSettings = EmailSetting::first();
        $emailMethods = EmailSetting::EMAIL_METHODS;

        return view('admin.setting.email_settings')
            ->with('emailSettings', $emailSettings)
            ->with('emailMethods', $emailMethods);
    }

    /**
     * update email settings
     *
     * @param UpdateEmailSettingsRequest request
     *
     * @return RedirectResponse
     */
    public function update(UpdateEmailSettingsRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['license_expired_notification'] = $request->input('license_expired_notification') ? true : false;
        $data['support_end_email_notification'] = $request->input('support_end_email_notification') ?  true : false;
        $data['update_license_expired_notification'] = $request->input('update_license_expired_notification') ?  true : false;
        $data['update_support_end_email_notification'] = $request->input('update_support_end_email_notification') ? true : false;


        if ($emailSettings = EmailSetting::first()) {
            $emailSettings->update($data);
        } else {
            EmailSetting::create($data);
        }
        return response()->json(["status" => true, 'data' => __('lang.success')]);
    }
}
