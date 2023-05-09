<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFavoriteRequest;
use App\Http\Services\PostFavoriteService;
use App\Models\Notification;
use Illuminate\Http\Request;

class PostFavoriteController extends Controller
{
    /**
     * Global value for PostFavoriteService and CategoryService
     */
    private $postFavoriteService;

    private $categoryService;

    private $notification;

    private $postService;

    /**
     * Initialize the PostFavoriteService via constructor
     *
     * @param  App\Http\Services\PostFavoriteService  $postFavoriteService
     */
    public function __construct(PostFavoriteService $postFavoriteService)
    {
        $this->postFavoriteService = $postFavoriteService;
        $this->notification = app(Notification::class);
    }

    /**
     * List all favorited posts
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $posts = $this->postFavoriteService->index();
        $notifications = $this->notification->getNotifsByUser();
        $count = $this->postFavoriteService->count();

        return view('favorites.index', compact('posts', 'notifications', 'count'));
    }

    /**
     * Store new post data
     *
     * @param Illuminate\Http\Requests\PostFavorite Request $request
     */
    public function store(PostFavoriteRequest $request)
    {
        $request = $request->validated();
        $post = $this->postFavoriteService->create($request);

        return response()->json($post['status'], $post['code']);

    }

    /**
     * Delete a post favorite
     *
     *
     * @return mixed|string
     */
    public function destroy(Request $request)
    {
        $post = $this->postFavoriteService->destroy($request->post_id, $request->user_id);

        return response()->json($post['status'], $post['code']);
    }
}
