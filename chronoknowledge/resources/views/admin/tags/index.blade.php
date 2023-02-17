@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.tags.create') }}"
            class="btn btn-primary text-decoration-none text-primary text-white" style="position:sticky;top:15%;left:70%;z-index:2">Create Tag<i class="fa-regular fa-plus ms-1"></i></a>
    <div class="container-fluid ps-5">
        <div class="row">
            @foreach ($tags as $tag)
            <div class="col-sm-4 col-xs-4 col-md-3 col-lg-3 col-xxl-3 my-3">
                <div class="card border px-1 py-1" style="width:fit-content">
                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="text-secondary">
                        {!! $tag->html_description !!}
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
