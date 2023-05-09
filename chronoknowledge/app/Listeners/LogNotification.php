<?php

namespace App\Listeners;

use App\Events\SendNotification;

class LogNotification
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
     * @param  App\Events\SendNotification  $event
     * @return void
     */
    public function handle(SendNotification $event)
    {
        // $event->channel;
        // $event->notifiable;
        // $event->notification;
        // $event->response;

        return true;
    }
}
