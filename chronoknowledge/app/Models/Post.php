<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\PostFavorite;
use App\Models\PostTag;
use App\Enums\PostStatus;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'plain_description',
        'html_description',
        'status'
    ];

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     *
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('slack_channel');
    }

    /** Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Get the likes for a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    /** Get the comments for a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    /** Get the favorites for a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(PostFavorite::class);
    }

    /** Get the favorites for a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(PostTag::class);
    }

    /**
     * List all posts
     */
    public function scopePostList($query)
    {
        return $query->with(['user',
        'likes', 'comments', 'favorites'])
            ->latest()
            ->paginate(10);
    }

    /**
     * List all active posts
     */
    public function scopePostActiveList($query)
    {
        return $query->with(['user',
        'likes', 'comments', 'favorites'])
            ->where('status', PostStatus::ACTIVE)
            ->latest()
            ->paginate(10);
    }

    /**
     * List all inactive posts
     */
    public function scopePostInactiveList($query)
    {
        return $query->with(['user',
        'likes', 'comments', 'favorites'])
            ->where('status', PostStatus::INACTIVE)
            ->latest()
            ->paginate(10);
    }
}
