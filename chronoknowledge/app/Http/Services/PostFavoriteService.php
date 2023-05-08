<?php

namespace App\Http\Services;

use App\Models\PostFavorite;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\PostFavoriteInterface;
use App\Components\ResponseComponent;
use Throwable;

class PostFavoriteService implements PostFavoriteInterface
{
    private $response;
    private $postFavorite;
    private $notification;
    private $post;

    public function __construct(ResponseComponent $response)
    {
        $this->response = $response;
        $this->postFavorite = app(PostFavorite::class);
        $this->notification = app(Notification::class);
        $this->post = app(Post::class);
    }

    public function index()
    {
        $favorites = $this->post->favoritePosts()->paginate(10);

        return $favorites;
    }

    public function admin()
    {
        $favorites = $this->postFavorite->getPost();

        return $favorites;
    }

    public function count()
    {
        return $this->post->favoritePosts()->count();
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
        DB::beginTransaction();
        try {
            $postFavorite = PostFavorite::create([
                'user_id' => $request['user_id'],
                'post_id' => $request['post_id']
            ]);

            if ($postFavorite) {
                $data = [
                    'user_id' => $postFavorite->user_id,
                    'receiver_id' => $postFavorite->post->user_id,
                    'post_id' => $postFavorite->post_id,
                    'notification_type' => 'favorited'
                ];

                $this->notification->createNotif($data);
            }

            DB::commit();
            return $this->response->succeed('favorite', 'create');
        } catch (Throwable $e) {
            DB::rollBack();

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
