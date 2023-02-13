@extends('layouts.app')
@section('right_sidebar')
    @include('layouts.right_sidebar')
@endsection
@section('content')
<div class="container flex justify-content-center align-items-center text-center ms-auto me-auto">
        @include('posts.index')
</div>
@endsection
