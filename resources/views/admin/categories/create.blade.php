@extends('layouts.admin')
@section('content')
    <div class="container py-5 h-100 mt-0" style="color: white">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-2 p-md-5 mt-0">
                        <h3>Create New Category </h3>
                        <form class="px-md-2" action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="title">Title</label>
                                <input type="text" id="title" class="form-control form-control-lg"
                                    value="{{ old('title') }}" name="title" placeholder="Title" />
                            </div>
                            @error('title')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
