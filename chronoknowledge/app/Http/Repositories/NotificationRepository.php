<?php

namespace App\Http\Repositories;

use App\Models\Notification;
use App\Events\SendNotification;
use App\Http\Repositories\BaseRepository;

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
            $request['post_id']['user_id'],
            'liked'
        ));

        return  $this->notification->create([
            'user_id' => $request['user_id']['id'],
            'receiver_id' => $request['post_id']['user_id'],
            'post_id' => $request['post_id']['id'],
            'notification_type' => $request['notification_type']
        ]);
    }
}
