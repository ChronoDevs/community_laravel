@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.tags.create') }}"
            class="btn btn-primary text-decoration-none text-primary text-white" style="position:sticky;top:15%;left:70%;">Create Tag<i class="fa-regular fa-plus ms-1"></i></a>
    <div class="container">
        <div class="row">
            @foreach ($tags as $tag)
            <div class="col col-sm-1 col-lg-1">
                <div class="card border px-3 py-1" style="width:fit-content">
                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="text-secondary">
                        {{ $tag->plain_description }}
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
