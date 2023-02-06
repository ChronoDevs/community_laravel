<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'description'
    ];

    public function savePostTag($request, $postId)
    {
        try{
            $tags = explode(',', $request['tag']);
            foreach ($tags as $tag) {
                if ($tag) {
                    $postTag = $this->create([
                        'post_id' => $postId,
                        'description' => $tag
                    ]);
                }
            }

            return $tags;
        }catch(Throwable $e) {
            return $e;
        }

    }

    public function editPostTag($request, $postId)
    {
        try{
            $existingTags = $this->postTagById($postId);
            $tags = explode(',', $request['tag']);
            $newTags = array_merge(array_diff($existingTags, $tags), array_diff($tags, $existingTags));
            foreach ($newTags as $tag) {
                if ($tag) {
                    $postTag = $this->create([
                        'post_id' => $postId,
                        'description' => $tag
                    ]);
                }
            }

            return $tags;
        }catch(Throwable $e) {
            return $e;
        }

    }

    /**
     * Returns list of post's tags
     *
     * @param
     */
    public function scopePostTagList($query)
    {
        return $query
            ->get();
    }

    public function scopePostTagById($query, $postId)
    {
        return $query->where('post_id', $postId)->get();
    }
}
