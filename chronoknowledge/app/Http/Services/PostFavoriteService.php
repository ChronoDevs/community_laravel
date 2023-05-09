<?php

namespace App\Http\Services;

use App\Components\ResponseComponent;
use App\Http\{
    Interfaces\PostFavoriteInterface,
    Repositories\NotificationRepository
};
use App\Models\{Notification, Post, PostFavorite};
use Illuminate\Support\Facades\DB;
use Throwable;

class PostFavoriteService implements PostFavoriteInterface
{
    private $response;

    private $postFavorite;

    private $post;

    private $notifRepository;

    public function __construct(ResponseComponent $response, NotificationRepository $notifRepository)
    {
        $this->response = $response;
        $this->postFavorite = app(PostFavorite::class);
        $this->post = app(Post::class);
        $this->notifRepository = $notifRepository;
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
                'post_id' => $request['post_id'],
            ]);

            if ($postFavorite) {
                $data = [
                    'user_id' => $postFavorite->user,
                    'receiver_id' => $postFavorite->post->user,
                    'post_id' => $postFavorite->post,
                    'notification_type' => 'favorited',
                ];

                $this->notifRepository->createNotif($data);
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
     * @param  int  $post_id
     * @param  int  $user_id
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
