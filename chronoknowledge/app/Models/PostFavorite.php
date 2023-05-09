<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PostFavorite extends Model
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
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
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
     * Relationship to logged in user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userLogged()
    {
        return $this->belongsTo(User::class)
            ->where('user_id', auth()->id());
    }

    /**
     * List all favorites by year
     */
    public function scopeFavoritesByYearList($query, $year)
    {
        return $query->with(['user', 'post'])
            ->select('favorites.*', DB::raw('YEAR(posts.created_at) as year, MONTH(posts.created_at) as month'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    }

    /**
     * List all likes by year
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeGetPost($query)
    {
        return $query->with('post', 'user')->get();
    }
}
