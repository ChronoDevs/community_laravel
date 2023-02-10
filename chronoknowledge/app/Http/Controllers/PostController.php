<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Services\PostService;
use App\Http\Services\CategoryService;
use App\Http\Services\TagService;
use App\Models\Post;
use App\Models\PostTag;
use App\Components\ResponseComponent;
use Throwable;

class PostController extends Controller
{
    /**
     * Global value for PostService and CategoryService
     *
     */
    private $postService;
    private $categoryService;
    private $response;
    private $postTag;
    private $tagService;

    /**
     * Initialize the PostService via constructor
     *
     * @param App\Http\Services\PostService $postService
     * @param App\Http\Services\CategoryService $categoryService
     */
    public function __construct(PostService $postService, CategoryService $categoryService, ResponseComponent $response, TagService $tagService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->response = $response;
        $this->postTag = app(PostTag::class);
        $this->tagService = $tagService;
    }

    /**
     * Returns the lists of posts
     */
    public function index(Request $request)
    {
        return $request;
        $posts = $this->postService->index($request);
        return $posts;
        return view('posts.index', compact ('$posts'));
    }

    /**
     * Returns post creation page
     */
    public function create(Request $request)
    {
        $categories = $this->categoryService->index();
        $tags = $this->tagService->getTags();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Returns users post viewing page
     *
     * @param App\Models\Post $post
     */
    public function show(Post $post, Request $request)
    {
        return view('posts.view', compact('post'));
    }

    /**
     * Returns post creation page
     *
     * @param App\Models\Post $post
     * @param Illuminate\Http\Request $request
     */
    public function edit(Post $post, Request $request)
    {
        $categories = $this->categoryService->index();
        $postTags = $this->tagService->getTagsByPost($post->id);
        $tags = $this->tagService->getTags();

        return view('posts.edit', compact('post', 'categories', 'tags', 'postTags'));
    }

    /**
     * Store new post data
     *
     * @param Illuminate\Http\Requests\PostRequest $request
     */
    public function store(PostRequest $request)
    {
        $user = $request->user();
        $request = $request->validated();
        $post = $this->postService->create($request, $user);

        return $this->response->formatView($post);
    }

    /**
     * Update post data
     *
     * @param App\Models\Post $post
     * @param Illuminate\Http\Requests\PostRequest $request
     */
    public function update(Post $post, PostRequest $request)
    {
        $request = $request->validated();
        $post = $this->postService->edit($request, $post);

        return $this->response->formatView($post);

    }
    /**
     * Delete a post
     *
     * @param \App\Models\Post $post
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed|string
     */
    public function destroy(Post $post, Request $request)
    {
        $post = $this->postService->destroy($post);

        return $this->response->formatView($post);
    }
}
