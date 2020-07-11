<?php

namespace App\Listeners;

use App\Events\TicketStatusChangedEvent;
use App\Mail\TicketStatusEmail;

class SendEmailNotificationTicketStatusChanged
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
     * @param  TicketStatusChangedEvent  $event
     * @return void
     */
    public function handle(TicketStatusChangedEvent $event)
    {
        \Mail::to($event->ticket->createdBy->email)->send(
            new TicketStatusEmail($event->ticket)
        );
    }
}
