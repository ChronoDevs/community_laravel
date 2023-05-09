<?php

namespace App\Http\Repositories;

use App\Events\SendNotification;
use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    /**
     * Notification instance
     */
    public $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Store new notification in the database
     */
    public function createNotif(mixed $request): Notification
    {
        event(new SendNotification(
            $request['user_id'],
            $request['post_id'],
            $request['receiver_id'],
            $request['notification_type']
        ));

        return $this->notification->create([
            'user_id' => $request['user_id']['id'],
            'receiver_id' => $request['post_id']['user_id'],
            'post_id' => $request['post_id']['id'],
            'notification_type' => $request['notification_type'],
        ]);
    }
}
