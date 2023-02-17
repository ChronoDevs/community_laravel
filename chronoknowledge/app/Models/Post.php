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
use App\Models\Category;
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

       /** Get the favorites for a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Scope function to get latest post
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeLatest($query)
    {
        return $query->latest();
    }

     /**
     * Scope function to get relationships for a post
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeRelationship($query)
    {
        return $query->with(['user','likes', 'comments', 'favorites']);
    }

    /**
     * List all posts
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePostList($query, $pagination=10)
    {
        return $query
            ->paginate($pagination);
    }

    /**
     * List all active posts
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePostActiveList($query)
    {
        return $query->relationship()
            ->where('status', PostStatus::ACTIVE)
            ->latest();
    }

    /**
     * List all inactive posts
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePostInactiveList($query)
    {
        return $query->relationship()
            ->where('status', PostStatus::INACTIVE)
            ->latest()
            ->paginate(10);
    }

    /**
     * List all posts by months
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePostByMonthList($query, $year)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            ->whereYear('created_at', $year)
            ->select('posts.*', DB::raw('DAY(created_at) as day, MONTH(posts.created_at) as month'))
            // ->whereYear('created_at', $year)
            ->orderBy('month', 'asc')
            ->orderBy('day', 'desc')
            ->get();
    }

    /**
     * List all posts by year
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePostByYearList($query)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            ->select('posts.*', 'posts.id as postId', DB::raw('YEAR(posts.created_at) as year, MONTH(posts.created_at) as month'))
            // ->whereYear('created_at', $year)
            ->orderBy('year', 'desc')
            ->get();
    }

    /**
     * Filters post by title
     *
     * @param string $keyword
     *
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePostFilterByTitle($query, $keyword)
    {
        return $query->where('posts.title', 'LIKE', '%' . $keyword . '%')
            ->orderBy('posts.id', 'desc');
    }

     /**
     * Filters post by category
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $keyword
     *
     * @return void
     */
    public function scopePostFilterByCategory($query, $keyword)
    {
        return $query->join('categories as c', function ($join) {
                $join->on('posts.category_id', '=', 'c.id');
            })
            ->where('c.title', 'LIKE', $keyword)
            ->join('post_tags as t', function ($join) {
                $join->on('posts.id', '=', 't.post_id');
            })
            ->orWhere('t.description', $keyword)
            ->select('posts.*', 'c.title as des')
            ->orderBy('posts.id', 'desc');
    }

    /**
     * Filters post by tag
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $keyword
     *
     * @return void
     */
    public function scopePostFilterByTag($query, $keyword)
    {
        return $query->join('post_tags as t', function ($join) {
                $join->on('posts.id', '=', 't.post_id');
            })
            ->where('t.description', $keyword);
            // ->orderBy('posts.id', 'desc');
    }

    /**
     * Filters post by relevance
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $keyword
     *
     * @return void
     */
    public function scopeRelevantPost($query)
    {
        return $query->with('category', 'tags')
            ->orderBy('posts.user_id', 'asc')
            ->get()
            ->sortBy('category.title')
            ->sortBy('tags.title');
    }

    /**
     * Filters post by top
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $keyword
     *
     * @return void
     */
    public function scopeTopPost($query)
    {
        return $query->withCount(['user', 'likes', 'comments', 'favorites'])
            ->orderBy('likes_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('favorites_count', 'desc');
    }

     /**
     * List all latest posts
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeLatestPost($query)
    {
        return $query->latest();
    }

     /**
     * List all favorited posts
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeFavoritePosts($query)
    {
        return $query->relationship()
            ->whereHas('favorites', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest();
    }

    /**
     * Paginate listed posts
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeCustomPaginate($query, $count)
    {
        return $query->paginate($count);
    }
}
