<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PostLike extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    /**
     * Relationship to post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function like()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relationship to user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Scope function to return likes
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopePostLikesList($query)
    {
        return $query;
    }

    /**
     * List all likes by year
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeLikesByYearList($query, $year)
    {
        return $query->with(['user', 'likes', 'comments', 'favorites'])
            // ->where('status', PostStatus::INACTIVE)
            ->select('likes.*', DB::raw('YEAR(posts.created_at) as year, MONTH(posts.created_at) as month'))
            // ->whereYear('created_at', $year)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    }
}
