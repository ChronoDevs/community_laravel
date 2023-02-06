@extends('layouts.admin')
@section('content')
    <div class="container py-5 h-100 mt-0" style="color: white">
        @can('deleteCategory', $category)
            <form id="deleteCategoryForm" action="{{ route('admin.categories.destroy', $category) }}" style="display: none"
                method="POST">
                @csrf
                @method('DELETE')
            </form>
            <a id="remove" href="javascript:void(0)" class="btn btn-danger text-decoration-none text-primary text-white"
                style="position:sticky;top:15%;left:70%;">
                Remove category<i class="fa-solid fa-trash ms-1"></i>
            </a>
        @endcan
        <div class="row d-flex justify-content-center align-items-center">
            @can('updateCategory', $category)
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-2 p-md-5 mt-0">
                            <h3>Edit the category </h3>
                            <form class="px-md-2" action="{{ route('admin.categories.update', $category) }}" method="POST">
                                @csrf
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="title">Title</label>
                                    <input type="text" id="title" class="form-control form-control-lg"
                                        value="{{ !old('title') ? $category->title : old('title') }}" name="title"
                                        placeholder="Title" />
                                </div>
                                @error('title')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
            @cannot('updateCategory', $category)
                <p>Sorry, you cannot update the category</p>
            @endcan
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#remove').click(function() {
                $('#deleteCategoryForm').submit();
            })
        });
    </script>
@endpush
