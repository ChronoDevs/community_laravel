<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostFavoriteService;
use App\Http\Requests\PostFavoriteRequest;

class PostFavoriteController extends Controller
{
    /**
     * Global value for PostFavoriteService and CategoryService
     *
     */
    private $postFavoriteService;
    private $categoryService;

    /**
     * Initialize the PostFavoriteService via constructor
     *
     * @param App\Http\Services\PostFavoriteService $postFavoriteService
     */
    public function __construct(PostFavoriteService $postFavoriteService)
    {
        $this->postFavoriteService = $postFavoriteService;
    }

    public function index()
    {
        $favorites = $this->postFavoriteService->index();

        return view('favorites.index', compact('favorites'));
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
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed|string
     */
    public function destroy(Request $request)
    {
        $post = $this->postFavoriteService->destroy($request->post_id, $request->user_id);

        return response()->json($post['status'], $post['code']);
    }
}
