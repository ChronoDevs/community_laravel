<?php

namespace App\Http\Services;

use App\Components\ResponseComponent;
use App\Http\Repositories\NotificationRepository;
use App\Models\{Notification, PostComment, User};
use App\Notifications\PostCommentNotification;
use Throwable;

class PostCommentService
{
    private $response;

    private $notifRepository;

    public function __construct(ResponseComponent $response, NotificationRepository $notifRepository)
    {
        $this->response = $response;
        $this->notifRepository = $notifRepository;
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
                'description' => $request['description'],
            ]);

            if ($postComment) {
                $data = [
                    'user_id' => $postComment->user,
                    'receiver_id' => $postComment->post->user,
                    'post_id' => $postComment->post,
                    'notification_type' => 'commented',
                ];

                $this->notifRepository->createNotif($data);
            }

            $user->notify(new PostCommentNotification($user, $postComment->post));

            return $this->response->succeed('comment', 'create');
        } catch (Throwable $e) {
            return $this->response->fail('comment', 'create');
        }
    }

    public function edit($postComment, $request)
    {
        try {
            $postComment->update([
                'description' => $request['description'],
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
