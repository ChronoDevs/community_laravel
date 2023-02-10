<?php

namespace App\Http\Services;

use App\Models\PostLike;
use Illuminate\Support\Facades\DB;
use App\Components\ResponseComponent;

class PostLikeService
{
    private $response;
    private $postLike;

    public function __construct(ResponseComponent $response)
    {
        $this->response = $response;
        $this->postLike = app(PostLike::class);
    }

    public function index() {
        return $this->postLike->postLikesList();
    }

    public function getLikesByYear() {
        return $this->postLike->likesByYearList();
    }

    public function create($request)
    {
        try {
            $postLike = PostLike::create([
                'user_id' => $request['user_id'],
                'post_id' => $request['post_id'],
            ]);

            return $this->response->succeed('post', 'create');
        } catch (Throwable $e) {
            return $this->response->fail('post', 'create');
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
    public function destroy($post_id, $user_id)
    {
        try {
            PostLike::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->whereNull('deleted_at')
                ->first()
                ->delete();

            return $this->response->succeed('post', 'delete');
        } catch (Throwable $e) {
            return $this->response->fail('post', 'delete');
        }
    }
}
