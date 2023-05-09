@extends('layouts.auth')
@section('sidebar')
    @include('layouts.guest_sidebar')
@endsection
@section('right_sidebar')
    @include('layouts.right_sidebar')
@endsection
@section('content')
    <div id="notification" class="info"></div>
    @include('posts.index')
    <h1 class="text-primary">{{ request()->getHost() }}</h1>
@endsection
