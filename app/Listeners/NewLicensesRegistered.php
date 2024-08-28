<?php

namespace App\Listeners;

use App\Events\NewLicensesRegisteredEvent;
use App\Models\Clients;
use App\Models\ClientUser;
use App\Models\ClientUserProduct;
use App\Models\License;
use App\Models\ProjectsManager;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewClientNotification;
use App\Notifications\NewLicenseNotification;
use App\Notifications\NewLicensesRegisteredNotification;
use App\Notifications\NewLicenseToAdminNotification;
use App\Notifications\NewLicenseToManagerNotification;
use App\Notifications\NewLicenseToUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewLicensesRegistered
{
    /**
     * @var \App\Models\Setting
     *  ? Collection From Setting Model
     */
    protected $setting;

    /**
     * @var \App\Models\Clients
     * ? Collection From Clients Model
     */
    protected $client;

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
    public function handle(NewLicensesRegisteredEvent $event)
    {
        $client = $event->client;
        $setting = $event->setting;
        $product = $event->product;
        $license = $event->license;

        // To Client
        $client->notify(new NewLicensesRegisteredNotification($client, $license));

         // To Admin
        $setting->notify(new NewLicenseToAdminNotification($setting, $license, $client));

        // Start Project Manager Functionality ( To Project Manager )
        $project_manager = ProjectsManager::where('client_id', $client->id)->get();

        $users = array();
        if($project_manager){
            foreach($project_manager as $manager){
                $users[] = User::where('id', $manager->manager_id)->get();
            }
        }
        foreach($users as $user) {
            foreach($user as $user_manager) {
                Notification::send($user_manager, new NewLicenseToManagerNotification($client, $license, $user_manager));
            };
        };
        // End Project Manager Functionality

        // Start Users Functionality ( To User )
        $clients = ClientUser::query()->where('client_id', $client->id)->limit(2)->get(); // Client Users

        $data = array();

        foreach ($clients as $cl) {
            $data[] = ClientUserProduct::query()
                ->where('product_id', $product->id)
                ->where('client_user_id', $cl->id)
                ->with('user')
                ->get();
        }
        foreach($data as $client_user){
            foreach($client_user as $us) {
                Notification::send($us->user, new NewLicenseToUserNotification($client, $license, $us->user));
            };
        };
        // End Users Functionality
    }
}
