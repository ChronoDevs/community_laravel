<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TagService;
use App\Models\Tag;
use App\Models\Notification;
use App\Components\ResponseComponent;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    private $tagService;
    private $response;
    private $notification;

    public function __construct(TagService $tagService, ResponseComponent $response)
    {
        $this->tagService = $tagService;
        $this->response = $response;
        $this->notification = app(Notification::class);
    }

    /**
     * Returns list of tags
     */
    public function index()
    {
        $tags = $this->tagService->index();
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.tags.index', compact('tags', 'notifications'));
    }

    /**
     * Returns creation of tags page
     */
    public function create()
    {
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.tags.create', compact('notifications'));
    }

    /**
     * Returns modification of tags page
     *
     * @param App\Models\Tag $tag
     */
    public function edit(Tag $tag)
    {
        $notifications = $this->notification->getNotifsByUser();

        return view('admin.tags.edit', compact('tag', 'notifications'));
    }

    /**
     * Store a new tag data
     *
     * @param App\Http\Requests\TagRequest $request
     */
    public function store(TagRequest $request)
    {
        $request = $request->validated();

        $tag = $this->tagService->create($request);

        return $this->response->formatView($tag);
    }

    /**
     * Update a tag data
     *
     * @param App\Http\Requests\TagRequest $request
     * @param App\Models\Tag $tag
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $request = $request->validated();

        $tag = $this->tagService->edit($request, $tag);

        return $this->response->formatView($tag);
    }

    /**
     * Delete a tag data
     *
     * @param App\Http\Requests\Tag $tag
     */
    public function destroy(Tag $tag)
    {

        $tag = $this->tagService->destroy($tag);

        return $this->response->formatView($tag);
    }
}
