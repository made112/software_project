<?php

namespace App\Providers;

use App\Events\EditProductEvent;
use App\Events\ForwardTicketEvent;
use App\Events\NewCompanyRegisteredEvent;
use App\Events\NewLicensesRegisteredEvent;
use App\Events\UpdateCompanyEvent;
use App\Events\UpdateLicensesEvent;
use App\Listeners\EditProductListener;
use App\Listeners\ForwardTicketListener;
use App\Listeners\NewCompanyRegistered;
use App\Listeners\NewLicensesRegistered;
use App\Listeners\UpdateCompanyListener;
use App\Listeners\UpdateLicensesListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewCompanyRegisteredEvent::class => [
            NewCompanyRegistered::class,
        ],
        NewLicensesRegisteredEvent::class => [
            NewLicensesRegistered::class,
        ],
        EditProductEvent::class => [
            EditProductListener::class,
        ],
        UpdateCompanyEvent::class => [
            UpdateCompanyListener::class,
        ],
        UpdateLicensesEvent::class => [
            UpdateLicensesListener::class,
        ],
        ForwardTicketEvent::class => [
            ForwardTicketListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
