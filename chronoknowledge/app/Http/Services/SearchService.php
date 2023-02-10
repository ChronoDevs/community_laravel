<?php

namespace App\Http\Services;

use App\Http\Interfaces\SearchInterface;

class SearchService implements SearchInterface
{
    public function index($keyword)
    {
        return 'hello world';
    }
}
