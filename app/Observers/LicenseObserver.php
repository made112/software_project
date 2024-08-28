<?php

namespace App\Observers;

use App\Models\License;
use App\Models\User;
use App\Notifications\BlockModelNotification;
use App\Notifications\NewLicenseNotification;
use App\Notifications\UpdateLicenseDateEmailNotification;
use Illuminate\Support\Facades\Notification;

class LicenseObserver
{
    /**
     * send email when create new client
     *
     * @param Clients $clients
     */
    public function created(License $license)
    {
        if (!is_null($license->client)) {
            try {
                $license->client->notify(new NewLicenseNotification($license));
            } catch (\Throwable $th) {
                activity()->causedBy(new User())->log("fail to send email to client : " . $license->client->name . " after creating new license to him : " . $license->license_code);
            }
        } else {
            activity()->causedBy(new User())->log('the license not assigned to client');
        }
    }

    /**
     * send block email to when deactivate client
     *
     * @param License $license
     */
    public function updated(License $license)
    {
        if ($license->isDirty('block')) {
            if ($license->block) {
                try {
                    Notification::send($license->client, new BlockModelNotification([
                        'title' => __('mail.block_license_title'),
                        'content' => __('mail.block_license_content', ['license_name' => $license->name]),
                        'license_code' =>  __('mail.license_code').': '.$license->license_code,
                        'product' =>  __('mail.product').': '.$license->product->name,
                        'flag' => 0,
                    ]));
                } catch (\Throwable $th) {
                    activity()->causedBy(new User())->log('cannot send email to clients : ' . $license->client->name .  'when block license');
                }
            }else{
                Notification::send($license->client, new BlockModelNotification([
                    'title' => __('mail.unblock_license_title'),
                    'content' => __('mail.unblock_license_content', ['license_name' => $license->name]),
                    'license_code' =>  __('mail.license_code').': '.$license->license_code,
                    'product' =>  __('mail.product').': '.$license->product->name,
                    'flag' => 1
                ]));
            }
        }
        if ($license->isDirty('date')) {

            try {
                $license->client->notify(new UpdateLicenseDateEmailNotification($license));
            } catch (\Throwable $th) {
                activity()->causedBy(new User())->log('cannot send email to clients : ' . $license->client->name .  'when update license expire data');
            }
        }
    }
}
