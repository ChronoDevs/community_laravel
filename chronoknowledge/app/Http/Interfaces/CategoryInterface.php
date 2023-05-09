<?php

namespace App\Http\Interfaces;

interface CategoryInterface
{
    public function index();

    public function create($request);

    public function edit($tag, $request);

    public function destroy($tag);
}
