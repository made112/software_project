<?php

namespace App\Listeners;

use App\Events\NewCompanyRegisteredEvent;
use App\Models\Clients;
use App\Models\ProjectsManager;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewClientNotification;
use App\Notifications\NewClientToAdminNotification;
use App\Notifications\NewClientToManagerNotification;
use App\Notifications\NewCompanyRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewCompanyRegistered
{
    /**
     * @var \App\Models\Clients;
     */
    protected $client;

    /**
     * @var \App\Models\Setting
     */
    protected $setting;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Clients $client, Setting $setting)
    {
        $this->client = $client;
        $this->setting = $setting;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewCompanyRegisteredEvent $event)
    {
        $client = $event->client;
        $setting = $event->setting;

        // To Company
        $client->notify(new NewClientNotification($client, $setting));

        // To Admin
        $setting->notify(new NewClientToAdminNotification($client, $setting));

        // Send Email To Project Manager
        $project_manager = ProjectsManager::where('client_id', $client->id)->get();

        $users = array();
        if($project_manager){
            foreach($project_manager as $manager){
                $users[] = User::where('id', $manager->manager_id)->get();
            }
        }
        foreach($users as $user) {
            foreach ($user as $user_manager) {
                Notification::send($user_manager, new NewClientToManagerNotification($client, $user_manager));
            }
        };


    }
}
