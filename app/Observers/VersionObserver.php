<?php

namespace App\Observers;

use App\Jobs\SendEmailToClientsWhenCreateProductVersion;
use App\Models\Clients;
use App\Models\Products;
use App\Models\Versions;
use Illuminate\Support\Facades\Notification;

class VersionObserver
{

    // public function created(Versions $versions)
    // {
    //     SendEmailToClientsWhenCreateProductVersion::dispatch($versions);
    // }
}
