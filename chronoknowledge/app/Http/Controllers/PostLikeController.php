<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLikeRequest;
use App\Http\Services\PostLikeService;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Global value for PostLikeService
     */
    private $postLikeService;

    /**
     * Initialize the PostService via constructor
     *
     * @param  App\Http\Services\PostLikeService  $postLikeService
     */
    public function __construct(PostLikeService $postLikeService)
    {
        $this->postLikeService = $postLikeService;
    }

    /**
     * Returns the lists of posts
     */
    public function index(Request $request)
    {
        $postLikes = $this->postLikeService->index();

        return view('likes.index', compact('$posts'));
    }

    /**
     * Store new post data
     *
     * @param  Illuminate\Http\Requests\PostLikeRequest  $request
     */
    public function store(PostLikeRequest $request)
    {
        $request = $request->validated();
        $post = $this->postLikeService->create($request);

        return response()->json($post['status'], $post['code']);

    }

    /**
     * Delete a post
     *
     *
     * @return mixed|string
     */
    public function destroy(Request $request)
    {
        $post = $this->postLikeService->destroy($request->post_id, $request->user_id);

        return response()->json($post['status'], $post['code']);
    }
}
