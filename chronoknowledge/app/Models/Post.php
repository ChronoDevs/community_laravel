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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return $query->with(['user','likes', 'comments', 'favorites'])
            ->latest()
            ->paginate(10);
    }

    /**
     * List all active posts
     */
    public function scopePostActiveList($query)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            ->where('status', PostStatus::ACTIVE)
            ->latest();
            // ->get();
    //         ->paginate(10);
    }

    /**
     * List all inactive posts
     */
    public function scopePostInactiveList($query)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            ->where('status', PostStatus::INACTIVE)
            ->latest()
            ->paginate(10);
    }

    /**
     * List all posts by months
     */
    public function scopePostByMonthList($query, $year)
    {
        DB::statement("SET SQL_MODE=''");
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            // ->where('status', PostStatus::ACTIVE)
            ->whereYear('created_at', $year)
            ->select('posts.*', DB::raw('DAY(created_at) as day, MONTH(posts.created_at) as month'))
            // ->whereYear('created_at', $year)
            ->orderBy('month', 'asc')
            ->orderBy('day' , 'desc')
            // ->groupBy('month', 'day')
            // ->groupBy('posts.created_at')
            // ->latest()
            ->get();
    }

    /**
     * List all posts by year
     */
    public function scopePostByYearList($query, $year)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            // ->where('status', PostStatus::INACTIVE)
            ->select('posts.*', 'posts.id as postId', DB::raw('YEAR(posts.created_at) as year, MONTH(posts.created_at) as month'))
            // ->whereYear('created_at', $year)
            ->orderBy('year', 'desc')
            ->get();
    }

    /**
     * Filters post
     *
     * @param string $keyword
     *
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePostFilter($query, $keyword)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('plain_description', 'LIKE', '%' . $keyword . '%')
            ->orWhere('html_description', 'LIKE', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
}
