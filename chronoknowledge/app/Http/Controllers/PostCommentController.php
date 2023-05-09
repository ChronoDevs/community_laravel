<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Http\Services\PostCommentService;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Global value for PostCommentService
     */
    private $postCommentService;

    /**
     * Initialize the PostCommentService via constructor
     *
     * @param  App\Http\Services\PostCommentService  $postCommentService
     */
    public function __construct(PostCommentService $postCommentService)
    {
        $this->postCommentService = $postCommentService;
    }

    /**
     * Store new post data
     *
     * @param  Illuminate\Http\Requests\PostCommentRequest  $request
     */
    public function store(PostCommentRequest $request)
    {
        $user = $request->user();
        $request = $request->validated();
        $comment = $this->postCommentService->create($request, $user);

        return response()->json($comment['status'], $comment['code']);

    }

    /**
     * Update post data
     *
     * @param  App\Models\PostComment  $comment
     * @param  Illuminate\Http\Requests\PostCommentRequest  $request
     */
    public function update(PostComment $comment, PostCommentRequest $request)
    {
        $request = $request->validated();
        $comment = $this->postCommentService->edit($comment, $request);

        return response()->json($comment['status'], $comment['code']);
    }

    /**
     * Delete a post
     *
     * @param  \App\Models\PostComment  $postComment
     * @return mixed|string
     */
    public function destroy(PostComment $comment, Request $request)
    {
        $comment = $this->postCommentService->destroy($comment);

        return response()->json($comment['status'], $comment['code']);
    }
}
