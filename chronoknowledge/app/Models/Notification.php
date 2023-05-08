<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\SendNotification;
use App\Models\User;
use App\Models\Post;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receiver_id',
        'post_id',
        'notification_type'
    ];

    /** Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /** Get the post that has the notif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * List all notifications
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeGetNotifs($query)
    {
        return $query->all();
    }

    /**
     * List all notifications by user
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeGetNotifsByUser($query)
    {
        return $query->where('receiver_id', auth()->id())
            ->get();
    }
}
