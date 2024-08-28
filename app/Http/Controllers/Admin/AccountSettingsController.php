<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ResetPasswordRequest;
use App\Http\Requests\Admin\Setting\UpdateAccountSettingsRequest;
use App\Models\City;
use App\Traits\FileUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{

    use FileUpload;

    /**
     * show account settings page
     *
     * @return View
     *
     */
    public function index(): View
    {
        $user = auth()->user();
        $cities = City::where('status', true)->get();

        return view('admin.setting.account')
            ->with('user', $user)
            ->with('cities', $cities);
    }

    /**
     * update account settings
     *
     * @param UpdateAccountSettingsRequest $request
     *
     * @return JsonResponse
     *
     */
    public function update(UpdateAccountSettingsRequest $request): JsonResponse
    {
        $data = $request->validated();

        $file = null;
        if ($request->has('user_photo')) {
            $file = $this->uploadFile($request->file("user_photo"));
        }

        if (!is_null($file)) {
            $data['photo'] = $file;
        }

        auth()->user()->update($data);
        return response()->json(['status' => true, 'data' =>  __('lang.success')]);
    }

    /**
     * reset password from account settings
     *
     * @param ResetPasswordRequest $request
     *
     * @return JsonResponse
     *
     */
    public function changePassword(ResetPasswordRequest $request): JsonResponse
    {
        auth()->user()->update([
            'password' => bcrypt($request->input('password'))
        ]);

        return response()->json(['status' => true, 'data' =>  __('lang.success')]);
    }
}
