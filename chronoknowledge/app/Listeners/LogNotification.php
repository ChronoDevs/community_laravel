<?php
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendNotification;
use Illuminate\Notifications\Events\NotificationSent;

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
     *
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
