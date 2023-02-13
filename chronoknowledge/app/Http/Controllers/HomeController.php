<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostService;
use App\Http\Services\TagService;
use App\Http\Services\CategoryService;
use App\Http\Services\PostLikeService;
use App\Http\Services\PostFavoriteService;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Throwable;

class HomeController extends Controller
{
    /**
     * Global value for PostService
     *
     */
    private $postService;
    private $tagService;
    private $categoryService;
    private $postFavoriteService;
    private $postLikeService;

    /**
     * Initialize the PostService via constructor
     */
    public function __construct(PostService $postService, TagService $tagService, CategoryService $categoryService,
        PostFavoriteService $postFavoriteService, PostLikeService $postLikeService)
    {
        $this->postService = $postService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
        $this->postLikeService = $postLikeService;
        $this->postFavoriteService = $postFavoriteService;
    }

    /**
     * Returns the lists of posts
     */
    public function index(Request $request)
    {
        $posts = $this->postService->index($request);
        $keyword = $request->search;
        $tags = $this->tagService->index();
        $categories = $this->categoryService->index();
        $view = auth()->check() ? 'home' : 'index';

        return view($view, compact ('posts', 'keyword', 'tags', 'categories'));
    }

    /**
     * Returns admin dashboard
     */
    public function admin(Request $request)
    {
        $categories = $this->categoryService->index();
        $posts = $this->postService->admin($request)->get()->toArray();
        $tags = $this->tagService->index();
        $likes = $this->postLikeService->index()->get();
        $favorites = $this->postFavoriteService->index();
        $postsByMonth = $this->postService->getPostByMonth(2023);
        $postsByYear = $this->postService->getPostByYear(2023);

        return view('admin.index', compact('categories', 'posts', 'tags', 'likes', 'favorites', 'postsByMonth', 'postsByYear'));
    }

    public function search(Request $request)
    {
        return dd($request);
    }
}
