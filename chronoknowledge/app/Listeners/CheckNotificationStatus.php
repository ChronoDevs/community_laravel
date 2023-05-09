<?php

namespace App\Listeners;

use Illuminate\Notifications\Events\NotificationSending;

class CheckNotificationStatus
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
     *
     * @return void
     */
    public function handle(NotificationSending $event)
    {
        return false;
        // $event->channel
        // $event->notifiable
        // $event->notification
    }
}
