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

    public function index($request)
    {
        if ($request->search) {
            return $this->post->postFilterByTitle($request->search);
        } elseif ($request->category) {
            return $this->post->postFilterByCategory($request->category);
        } elseif ($request->tag) {
            return $this->post->postFilterByTag($request->tag);
        } else {
            return $this->post->postList();
        }
    }

    public function getPostByYear($year)
    {
        return $this->post->postByYearList($year);
    }

    public function getPostByMonth($year)
    {
        return $this->post->postByMonthList($year);
    }

    public function admin($request)
    {
        if ($request->search) {
            return $this->post->postFilter($request->search);
        }

        return $this->post->postList();
    }

    public function create($request, $user)
    {
        try {
            $post = Post::create([
                'user_id' => $request['user_id'],
                'category_id' => $request['category'],
                'title' => $request['title'],
                'plain_description' => strip_tags($request['description']),
                'html_description' => $request['description'],
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
                'plain_description' => strip_tags($request['description']),
                'html_description' => $request['description'],
                'status' => PostStatus::ACTIVE
            ]);

            $postTag = $this->postTag->savePostTag($request, $post->id);

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
