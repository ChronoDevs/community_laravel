<?php

namespace App\Http\Services;

use App\Components\ResponseComponent;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostTag;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

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
            return $posts->postFilterByTitle($request->search)->get();
        }
        if ($request->category) {
            return $posts->postFilterByCategory($request->category)->get();
        }
        if ($request->tag) {
            return $posts->postFilterByTag($request->tag)->get();
        }
        if ($request->filter == 'relevant') {
            return $posts->relevantPost();
        }
        if ($request->filter == 'latest') {
            return $posts->latestPost()->get();
        }
        if ($request->filter == 'top') {
            return $posts->topPost()->get();
        }

        return $posts->postList(10);
    }

    public function countPosts()
    {
        return $this->post->latest()->count();
    }

    public function countActivePosts()
    {
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
        DB::beginTransaction();
        try {
            $post = Post::create([
                'user_id' => $request['user_id'],
                'category_id' => $request['category'],
                'title' => $request['title'],
                'plain_description' => strip_tags($request['description']),
                'html_description' => $request['description'],
                'status' => PostStatus::ACTIVE,
            ]);
            $postTag = $this->postTag->savePostTag($request, $post->id);

            $notif = $user->notify(new PostNotification($user, $post));
            DB::commit();

            return $this->response->succeed('post', 'create', 'home');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e);

            return $this->response->fail('post', 'create', 'home');
        }
    }

    public function edit($request, $post)
    {
        DB::beginTransaction();
        try {
            $post->update([
                'category_id' => $request['category'],
                'title' => $request['title'],
                'plain_description' => strip_tags($request['description']),
                'html_description' => $request['description'],
                'status' => PostStatus::ACTIVE,
            ]);

            $postTag = $this->postTag->savePostTag($request, $post->id);
            DB::commit();

            return $this->response->succeed('post', 'edit', 'home');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e);

            return $this->response->fail('post', 'edit', 'home');
        }
    }

    public function adminEdit($request, $post)
    {
        try {
            $post = $post->update([
                'status' => $request->status ? PostStatus::ACTIVE : PostStatus::INACTIVE,
            ]);

            return $post;
        } catch (Throwable $e) {
            Log::error($e);

            return $e;
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return $this->response->succeed('post', 'delete', 'home');
        } catch (Throwable $e) {
            Log::error($e);

            return $this->response->fail('post', 'delete', 'home');
        }
    }
}
