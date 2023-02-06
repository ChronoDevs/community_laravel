<?php

namespace App\Http\Services;

use App\Models\PostComment;
use Illuminate\Support\Facades\DB;
use App\Components\ResponseComponent;
use App\Notifications\PostCommentNotification;
use App\Models\User;

class PostCommentService
{
    private $response;
    private $postComment;

    public function __construct(ResponseComponent $response)
    {
        $this->response = $response;
        $this->postComment = app(PostComment::class);
    }

    public function index()
    {
        $postComments = PostComment::with(['user', 'post'])
            ->latest()
            ->get();

        return $postComments;
    }

    public function create($request, User $user)
    {
        try {
            $postComment = PostComment::create([
                'user_id' => $request['user_id'],
                'post_id' => $request['post_id'],
                'description' => $request['description']
            ]);

            $notif = $user->notify(new PostCommentNotification($user, $postComment->post));

            return $this->response->succeed('comment', 'create');
        } catch (Throwable $e) {
            return $this->response->fail('comment', 'create');
        }
    }

    public function edit($postComment, $request)
    {
        try {
            $postComment->update([
                'description' => $request['description']
            ]);

            return $this->response->succeed('comment', 'edit');
        } catch (Throwable $e) {
            return $this->response->fail('comment', 'edit');
        }

    }

    public function destroy($postComment)
    {
        try {
            $postComment->delete();

            return $this->response->succeed('comment', 'delete');
        } catch (Throwable $e) {
            return $this->response->fail('comment', 'delete');
        }
    }
}
