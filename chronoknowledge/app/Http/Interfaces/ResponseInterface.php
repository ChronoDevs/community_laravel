<?php

namespace App\Http\Interfaces;

interface ResponseInterface
{
    public function succeed($data, $type);

    public function fail($data, $type);
}
