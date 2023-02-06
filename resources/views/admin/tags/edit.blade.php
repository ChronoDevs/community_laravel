@extends('layouts.admin')
@section('content')
    <div class="container py-5 h-100 mt-0" style="color: white">
        @can('deleteTag', $tag)
            <form id="deleteTagForm" action="{{ route('admin.tags.destroy', $tag) }}" style="display: none" method="POST">
                @csrf
                @method('DELETE')
            </form>
            <a id="remove" href="javascript:void(0)" class="btn btn-danger text-decoration-none text-primary text-white"
                style="position:sticky;top:15%;left:70%;">
                Remove Tag<i class="fa-solid fa-trash ms-1"></i>
            </a>
            <div class="row d-flex justify-content-center align-items-center">
            @endcan
            @can('updateTag', $tag)
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-2 p-md-5 mt-0">
                            <h3>Edit the tag </h3>
                            <form class="px-md-2" action="{{ route('admin.tags.update', $tag) }}" method="POST">
                                @csrf
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="title">Title</label>
                                    <input type="text" id="title" class="form-control form-control-lg"
                                        value="{{ !old('title') ? $tag->title : old('title') }}" name="title"
                                        placeholder="Title" />
                                </div>
                                @error('title')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="plainDescription">Plain Description</label>
                                    <input type="text" id="plainDescription" class="form-control form-control-lg"
                                        value="{{ !old('plain_description') ? $tag->plain_description : old('plain_description') }}"
                                        name="plain_description" placeholder="Middle Name" />
                                </div>
                                @error('plain_description')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="htmlDescription">HTML Description</label>
                                    <input type="text" id="htmlDescription" class="form-control form-control-lg"
                                        value="{{ !old('html_description') ? $tag->html_description : old('html_description') }}"
                                        name="html_description" placeholder="HTML Description" />
                                </div>
                                @error('html_description')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
            @cannot('updateTag', $tag)
                <p>Sorry, you cannot update the tag</p>
            @endcan
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#remove').click(function() {
                $('#deleteTagForm').submit();
            })
        });
    </script>
@endpush
