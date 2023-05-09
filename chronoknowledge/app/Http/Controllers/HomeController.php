<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;
use App\Http\Services\PostFavoriteService;
use App\Http\Services\PostLikeService;
use App\Http\Services\PostService;
use App\Http\Services\TagService;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Global value for PostService
     */
    private $postService;

    private $tagService;

    private $categoryService;

    private $postFavoriteService;

    private $postLikeService;

    private $notification;

    /**
     * Initialize the PostService via constructor
     *
     * @param  App\Http\Services\PostService  $postService
     * @param  App\Http\Services\TagService  $tagService
     * @param  App\Http\Services\CategoryService  $categoryService
     * @param  App\Http\Services\PostFavoriteService  $postFavoriteService
     * @param  App\Http\Services\PostLikeService  $postLikeService
     */
    public function __construct(
        PostService $postService,
        TagService $tagService,
        CategoryService $categoryService,
        PostFavoriteService $postFavoriteService,
        PostLikeService $postLikeService
    ) {
        $this->postService = $postService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
        $this->postLikeService = $postLikeService;
        $this->postFavoriteService = $postFavoriteService;
        $this->notification = app(Notification::class);
    }

    /**
     * Returns the lists of posts
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $posts = $this->postService->index($request);
        $keyword = $request->search;
        $tags = $this->tagService->index();
        $categories = $this->categoryService->index();
        $view = auth()->check() ? 'home' : 'index';
        $notifications = $this->notification->getNotifsByUser();
        $count = $this->postService->countPosts();

        return view($view, compact('posts', 'keyword', 'tags', 'categories', 'notifications', 'count'));
    }

    /**
     * Returns the lists of active posts
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function listing(Request $request)
    {
        $posts = $this->postService->listing($request);
        $tags = $this->tagService->index();
        $categories = $this->categoryService->index();
        $notifications = $this->notification->getNotifsByUser();
        $count = $this->postService->countActivePosts();

        return view('listing.index', compact('posts', 'tags', 'categories', 'notifications', 'count'));
    }

    /**
     * Return static pages
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function public(Request $request)
    {
        $view = last(explode('/', request()->url()));
        $notifications = $this->notification->getNotifsByUser();

        return view($view.'.index', compact('notifications'));
    }

    /**
     * Returns admin dashboard
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function admin(Request $request)
    {
        $categories = $this->categoryService->index();
        $posts = $this->postService->admin($request)->toArray();
        $tags = $this->tagService->index();
        $likes = $this->postLikeService->index()->get();
        $favorites = $this->postFavoriteService->admin();
        $postsByMonth = $this->postService->getPostByMonth(2023);
        $postsByYear = $this->postService->getPostByYear();
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.index', compact(
            'categories',
            'posts',
            'tags',
            'likes',
            'favorites',
            'postsByMonth',
            'postsByYear',
            'notifications'
        ));
    }
}
