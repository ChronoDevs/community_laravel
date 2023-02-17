<?php

namespace App\Http\Interfaces;

interface PostFavoriteInterface
{
    public function index();
    public function admin();
    public function count();
    public function create($request);
    public function destroy($userId, $postId);
}
