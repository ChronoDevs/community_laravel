@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.categories.create') }}"
            class="btn btn-primary text-decoration-none text-primary text-white mb-4" style="position:sticky;top:15%;left:70%;z-index:2">Create Category<i class="fa-regular fa-plus ms-1"></i></a>
    <div class="container-fluid ps-5">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-sm-4 col-xs-4 col-md-3 col-lg-3 col-xxl-3 my-3">
                <div class="card px-3 py-1" style="width:fit-content">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-secondary">
                        {{ $category->title }}
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
@push('scripts')

@endpush
