<?php

namespace App\Observers;

use App\Models\Clients;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\BlockModelNotification;
use App\Notifications\NewClientNotification;

class ClientsObserver
{
    /**
     * send email when create new client
     *
     * @param Clients $clients
     */
    public function created(Clients $clients)
    {
        try {
            $clients->notify(new NewClientNotification());
        } catch (\Throwable $th) {
            activity()->causedBy(new User())->log("fail to send email to new client : " . $clients->name);
        }
    }

    /**
     * send block email to when deactivate client
     *
     * @param Clients $clients
     */
    public function updated(Clients $clients)
    {
        if ($clients->isDirty('status')) {
            if ($clients->status == 2) {
                $clients->notify(new BlockModelNotification([
                    'title' => __('mail.block_client_title'),
                    'content' => __('mail.block_client_content', ['client_name' => $clients->name])
                ]));
            }
        }
    }
}
