<?php

namespace App\Http\Services;

use App\Models\Tag;
use App\Models\PostTag;
use App\Http\Interfaces\TagInterface;
use App\Components\ResponseComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class TagService implements TagInterface
{
    private $tag;
    private $response;
    private $postTag;

    public function __construct(ResponseComponent $response)
    {
        $this->tag = app(Tag::class);
        $this->response = $response;
        $this->postTag = app(PostTag::class);
    }

    public function getTags($postId)
    {
        $tags = $this->postTag->postTagById($postId);
        $tag2 = '';
        foreach($tags as $tag) {
            if (!$tag->last) {
                $tag2 .= $tag['description'] . ', ';
            }
        };
        return $tag2;
    }

    public function index()
    {
        $tags = $this->tag->tagList();

        return $tags;
    }

    public function create($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->tag->create([
                    ...$request
                ]);
            });

            return $this->response->succeed('tag', 'create', 'admin.tags.index');
        } catch (Throwable $e) {
            return $this->response->fail('tag', 'create', 'admin.tags.create');
        }
    }

    public function edit($request, $tag)
    {
        try {
            DB::transaction(function () use ($request, &$tag) {
                $tag->update([
                    ...$request
                ]);
            });

            return $this->response->succeed('tag', 'edit', 'admin.tags.index');
        } catch (Throwable $e) {
            return $this->response->fail('tag', 'edit', 'admin.tags.index');
        }

    }

    public function destroy($tag)
    {
        try {
            $tag->delete();

            return $this->response->succeed('tag', 'delete', 'admin.tags.index');
        } catch (Throwable $e) {
            return $this->response->fail('tag', 'delete', 'admin.tags.edit');
        }
    }
}
