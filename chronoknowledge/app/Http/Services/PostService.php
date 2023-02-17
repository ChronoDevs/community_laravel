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
        $posts = $this->post->relationship();

        if ($request->search) {
            $posts = $posts->postFilterByTitle($request->search);
        }
        if ($request->category) {
            $posts = $posts->postFilterByCategory($request->category);
        }
        if ($request->tag) {
            $posts = $posts->postFilterByTag($request->tag);
        }
        if ($request->filter == 'relevant') {
            $posts = $posts->relevantPost();
        }
        if ($request->filter == 'latest') {
            $posts = $posts->latestPost();
        }
        if ($request->filter == 'top') {
            $posts = $posts->topPost();
        }

        return $posts->postList($request->pagination);
    }

    public function countPosts() {
        return $this->post->latest()->count();
    }

    public function countActivePosts() {
        return $this->post->postActiveList()->count();
    }

    public function listing($request)
    {
        return $this->post->postActiveList()->postList($request->pagination);
    }

    public function getPostByYear()
    {
        return $this->post->postByYearList();
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

        return $this->post->latest()->get();
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

    public function adminEdit($request, $post)
    {
        try {
            $post = $post->update([
                'status' => $request->status ? PostStatus::ACTIVE : PostStatus::INACTIVE
            ]);

            return $post;
        } catch (Throwable $e) {
            return $e;
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
