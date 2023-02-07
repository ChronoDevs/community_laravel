<?php

namespace App\Http\Services;

use App\Http\Interfaces\FileHandlingInterface;

class FileHandlingService implements FileHandlingInterface
{
    public function index()
    {
        return 'Hello world';
    }
}
