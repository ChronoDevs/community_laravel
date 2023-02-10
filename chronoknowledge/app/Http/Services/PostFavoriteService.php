<?php

namespace App\Http\Services;

use App\Models\PostFavorite;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\PostFavoriteInterface;
use App\Components\ResponseComponent;

class PostFavoriteService implements PostFavoriteInterface
{
    private $response;
    private $postFavorite;

    public function __construct(ResponseComponent $response)
    {
        $this->response = $response;
        $this->postFavorite = app(PostFavorite::class);
    }

    public function index()
    {
        $favorites = PostFavorite::all();

        return $favorites;
    }

    /**
     * Returns list of favorites with years and months
     */
    public function getFavoritesByYear()
    {
        return $this->postFavorite->getFavoritesByYearList();
    }

    public function create($request)
    {
        try {
            $postFavorite = PostFavorite::create([
                'user_id' => $request['user_id'],
                'post_id' => $request['post_id']
            ]);

            return $this->response->succeed('favorite', 'create');
        } catch (Throwable $e) {
            return $this->response->fail('favorite', 'create');
        }
    }

    /**
     * Function to delete or unlike a post
     *
     * @param int $post_id
     * @param int $user_id
     *
     * @return array|mixed
     */
    public function destroy($postId, $userId)
    {
        try {
            PostFavorite::where('user_id', $userId)
                ->where('post_id', $postId)
                ->whereNull('deleted_at')
                ->first()
                ->delete();

            return $this->response->succeed('favorite', 'delete');
        } catch (Throwable $e) {
            return $this->response->fail('favorite', 'delete');
        }
    }
}
