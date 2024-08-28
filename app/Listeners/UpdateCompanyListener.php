<?php

namespace App\Listeners;

use App\Events\UpdateCompanyEvent;
use App\Models\Clients;
use App\Models\ProjectsManager;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\AddNewManagerToCompanyNotification;
use App\Notifications\NewClientNotification;
use App\Notifications\UpdateCompanyNotification;
use App\Notifications\UpdateCompanyToAdminNotification;
use App\Notifications\UpdateCompanyToManagerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UpdateCompanyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateCompanyEvent $event)
    {
        $client = $event->client;

        $setting = Setting::where('id', 1)->first();

        $client->notify(new UpdateCompanyNotification($client));
        $setting->notify(new UpdateCompanyToAdminNotification($client, $setting));

        // Send Email To Project Manager
        $project_manager = ProjectsManager::where('client_id', $client->id)->get();

        $users = array();
        if($project_manager){
            foreach($project_manager as $manager){
                $users[] = User::where('id', $manager->manager_id)->get();
            }
        }
        foreach($users as $user) {
            foreach ($user as $us) {
                Notification::send($us, new UpdateCompanyToManagerNotification($client, $us));
            }
        };



    }
}
