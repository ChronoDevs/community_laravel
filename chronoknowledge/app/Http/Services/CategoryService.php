<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Http\Interfaces\CategoryInterface;
use App\Components\ResponseComponent;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryService implements CategoryInterface
{
    private $category;
    private $response;

    public function __construct(ResponseComponent $response)
    {
        $this->category = app(Category::class);
        $this->response = $response;
    }

    public function index()
    {
        $categories = $this->category->categoryList();

        return $categories;
    }

    public function create($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->category->create([
                    ...$request
                ]);
            });

            return $this->response->succeed('category', 'create', 'admin.categories.index');
        } catch (Throwable $e) {
            return $this->response->fail('category', 'create', 'admin.categories.create');
        }
    }

    public function edit($request, $category)
    {
        try {
            DB::transaction(function () use ($request, &$category) {
                $category->update([
                    ...$request
                ]);
            });

            return $this->response->succeed('category', 'edit', 'admin.categories.index');
        } catch (Throwable $e) {
            return $this->response->fail('category', 'edit', 'admin.categories.edit');
        }

    }

    public function destroy($category)
    {
        try {
            $category->delete();

            return $this->response->succeed('category', 'delete', 'admin.categories.index');
        } catch (Throwable $e) {
            return $this->response->fail('category', 'delete', 'admin.categories.edit');
        }
    }
}
