<?php

namespace App\Observers;

use App\Models\ClientUser;
use App\Models\User;
use App\Models\Clients;
use App\Notifications\BlockModelNotification;
use App\Notifications\NewClientUserNotification;
use App\Notifications\NotifyClientForNewClientUserNotification;
use Illuminate\Support\Facades\Notification;

class ClientUserObserver
{
    /**
     * - send email notification for client after assign new user to him
     *
     * - send welcome email to user after register them
     *
     * @param ClientUser $clientUser
     */
    public function created(ClientUser $clientUser)
    {
        try {
            Notification::send($clientUser, new NewClientUserNotification());
        } catch (\Throwable $th) {
            activity()->log("fail to send email to new client user : " . $clientUser->name . '\n' . $th->getMessage());
        }
        try {
            Notification::send($clientUser->client, new NotifyClientForNewClientUserNotification($clientUser));
        } catch (\Throwable $th) {
            activity()->causedBy(new User())->log("fail to send email to client : " . $clientUser->client->name . " after add new client user : " . $clientUser->name . '\n' . $th->getMessage());
        }
    }


    /**
     * send block email to when deactivate client user
     *
     * @param ClientUser $clientUser
     */
    public function updated(ClientUser $clientUser)
    {
        if ($clientUser->isDirty('status')) {
            if ($clientUser->status == 2) {
                $client = Clients::find($clientUser->client_id);
                if($client){
                    $client->notify(new BlockModelNotification([
                        'title' => __('mail.block_client_user_title'),
                        'content' => __('mail.block_client_user_content', ['client_user' => $clientUser->name])
                    ]));
                }

                $clientUser->notify(new BlockModelNotification([
                    'title' => __('mail.block_account'),
                    'content' => __('mail.your_account_blocked')
                ]));
            }
        }
    }
}
