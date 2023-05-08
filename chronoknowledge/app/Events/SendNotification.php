<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Post;

class SendNotification implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The notification type.
     *
     * @var string
     */
    public $type;
    /**
     * User instance
     *
     * @var App\Models\User
     */
    public $user;
    /**
     * User instance
     *
     * @var App\Models\User
     */
    public $owner;
    /**
     * Post instance
     *
     */
    public $post;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Post $post
     * @param User $owner
     * @param string $type
     *
     */
    public function __construct($user, $post, $owner,  $type)
    {
        $this->type  = $type;
        $this->user  = $user;
        $this->post  = $post;
        $this->owner = $owner;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user-channel');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'UserEvent';
    }

    /**
     * The event's broadcast name.
     *
     * @return array<string>
     */
    public function broadcastWith()
    {
        return ['title'=>'This notification is from Chronoknowledge'];
    }
}
