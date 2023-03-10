<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Support\Facades\DB;
use App\Enums\PostStatus;
use App\Notifications\PostNotification;
use App\Components\ResponseComponent;

class PostService
{
    private $post;
    private $response;
    private $postTag;

    public function __construct(ResponseComponent $response)
    {
        $this->post = app(Post::class);
        $this->response = $response;
        $this->postTag = app(PostTag::class);
    }

    public function index()
    {
        $posts = $this->post->postList();
            // ->map(function($post) {
            //     return collect([
            //         'id' => $post->id,
            //         'user_id' => $post->user_id,
            //         'post_id' => $post->category_id,
            //         'title' => $post->title,
            //         'plain_description' => $post->plain_description,
            //         'html_description' => $post->html_description,
            //         'status' => $post->status == 1 ? PostStatus::ACTIVE : PostStatus::INACTIVE
            //     ]);
            // });

        return $posts;
    }

    public function create($request, $user)
    {
        try {
            $post = Post::create([
                'user_id' => $request['user_id'],
                'category_id' => $request['category'],
                'title' => $request['title'],
                'plain_description' => $request['plain_description'],
                'html_description' => $request['html_description'],
                'status' => PostStatus::ACTIVE
            ]);
            $postTag = $this->postTag->savePostTag($request, $post->id);

            $notif = $user->notify(new PostNotification($user, $post));

            return $this->response->succeed('post', 'create', 'home');
        } catch (Throwable $e) {

            return $this->response->fail('post', 'create', 'home');
        }
    }

    public function edit($request, $post)
    {
        try {
            $post->update([
                'category_id' => $request['category'],
                'title' => $request['title'],
                'plain_description' => $request['plain_description'],
                'html_description' => $request['html_description'],
                'status' => PostStatus::ACTIVE
            ]);

            return $this->response->succeed('post', 'edit', 'home');
        } catch (Throwable $e) {
            return $this->response->fail('post', 'edit', 'home');
        }

    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return $this->response->succeed('post', 'delete', 'home');
        } catch (Throwable $e) {
            return $this->response->fail('post', 'delete', 'home');
        }
    }
}
