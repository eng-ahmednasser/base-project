<?php

namespace App\Providers;

use App\Events\NewTicketEvent;
use App\Events\TicketStatusChangedEvent;
use App\Listeners\SendEmailNotificationNewTicket;
use App\Listeners\SendEmailNotificationTicketStatusChanged;
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
        NewTicketEvent::class => [
            SendEmailNotificationNewTicket::class,
        ],
        TicketStatusChangedEvent::class => [
            SendEmailNotificationTicketStatusChanged::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
