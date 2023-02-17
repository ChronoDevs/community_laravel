<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Requests\CategoryRequest;
use App\Components\ResponseComponent;
use App\Models\Category;
use App\Models\Notification;

class CategoryController extends Controller
{
    private $categoryService;
    private $response;
    private $notification;

    public function __construct(CategoryService $categoryService, ResponseComponent $response)
    {
        $this->categoryService = $categoryService;
        $this->response = $response;
        $this->notification = app(Notification::class);
    }

    /**
     * Returns list of categorys
     */
    public function index()
    {
        $categories = $this->categoryService->index();
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.categories.index', compact('categories', 'notifications'));
    }

    /**
     * Returns creation of categorys page
     */
    public function create()
    {
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.categories.create', compact('notifications'));
    }

    /**
     * Returns modification of categorys page
     *
     * @param App\Models\Category $category
     */
    public function edit(Category $category)
    {
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.categories.edit', compact('category', 'notifications'));
    }

    /**
     * Store a new category data
     *
     * @param App\Http\Requests\CategoryRequest $request
     */
    public function store(CategoryRequest $request)
    {
        $request = $request->validated();

        $category = $this->categoryService->create($request);

        return $this->response->formatView($category);
    }

    /**
     * Update a category data
     *
     * @param App\Http\Requests\CategoryRequest $request
     * @param App\Models\Category $category
     */
    public function update(CategoryRequest $request, category $category)
    {
        $request = $request->validated();

        $category = $this->categoryService->edit($request, $category);

        return $this->response->formatView($category);
    }

    /**
     * Delete a category data
     *
     * @param App\Http\Requests\Category $category
     */
    public function destroy(Category $category)
    {

        $category = $this->categoryService->destroy($category);

        return $this->response->formatView($category);
    }
}
