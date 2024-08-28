<?php

namespace App\Listeners;

use App\Events\UpdateLicensesEvent;
use App\Models\ClientUser;
use App\Models\ClientUserProduct;
use App\Models\License;
use App\Models\ProjectsManager;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewLicensesRegisteredNotification;
use App\Notifications\UpdateLicensesNotification;
use App\Notifications\UpdateLicenseToAdminNotification;
use App\Notifications\UpdateLicenseToManagerNotification;
use App\Notifications\UpdateLicenseToUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UpdateLicensesListener
{
    /**
     * @var License
     */
    public License $license;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(License $license)
    {
        $this->license = $license;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateLicensesEvent $event)
    {
        $client = $event->license->client;
        $setting = Setting::where('id', 1)->first();
        $product = $event->license->product;
        $license = $event->license;

        $client->notify(new UpdateLicensesNotification($license, $client, $product));
        $setting->notify(new UpdateLicenseToAdminNotification($license, $client, $product, $setting));

        // Start Project Manager Functionality
        $project_manager = ProjectsManager::where('client_id', $client->id)->get();

        $users = array();
        if($project_manager){
            foreach($project_manager as $manager){
                $users[] = User::where('id', $manager->manager_id)->get();
            }
        }
        foreach($users as $user) {
            foreach ($user as $us) {
                Notification::send($us, new UpdateLicenseToManagerNotification($client, $license, $product, $us));
            }
        };
        // End Project Manager Functionality

        // Start Users Functionality
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
                Notification::send($us->user, new UpdateLicenseToUserNotification($client, $license, $product, $us->user));
            };
        };
        // End Users Functionality
    }
}
