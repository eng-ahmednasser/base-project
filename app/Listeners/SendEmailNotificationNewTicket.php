<?php

namespace App\Listeners;

use App\Events\NewTicketEvent;
use App\Mail\NewTicketEmail;

class SendEmailNotificationNewTicket
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
     * @param  NewTicketEvent  $event
     * @return void
     */
    public function handle(NewTicketEvent $event)
    {
        \Mail::to($event->ticket->assignedTo->email)->send(
            new NewTicketEmail($event->ticket)
        );
    }
}
