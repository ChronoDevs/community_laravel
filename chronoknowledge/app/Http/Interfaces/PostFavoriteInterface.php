<?php

namespace App\Http\Interfaces;

interface PostFavoriteInterface
{
    public function index();
    public function create($request);
    public function destroy($userId, $postId);
}
