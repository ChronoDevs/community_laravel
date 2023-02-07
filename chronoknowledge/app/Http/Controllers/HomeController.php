<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostService;
use App\Http\Services\TagService;
use App\Http\Services\CategoryService;
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

    /**
     * Initialize the PostService via constructor
     */
    public function __construct(PostService $postService, TagService $tagService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
    }

    /**
     * Returns the lists of posts
     */
    public function index(Request $request)
    {

        $posts = $this->postService->index();

        return view('index', compact ('posts'));
    }

    /**
     * Returns admin dashboard
     */
    public function admin()
    {

        $categories = $this->categoryService->index();
        $posts = $this->postService->index();
        $tags = $this->tagService->index();

        return view('admin.index', compact('categories', 'posts', 'tags'));
    }
}
