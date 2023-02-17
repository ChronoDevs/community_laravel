@extends('layouts.app')
@section('content')
    <div class="container py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-2 p-md-5">
                        <h3 class="text-light text-center">Create New Post</h3>
                        <form class="px-md-2" action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="form-outline mb-1">
                                <label class="form-label float-left text-light" for="category">Category</label>
                                <select class="select form-control form-control-lg input-dark" name="category">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (old('category') == $category->id) selected @endif>{{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label float-left text-light" for="title">Title</label>
                                <input type="text" id="title" class="form-control form-control-lg input-dark"
                                    value="{{ old('title') }}" name="title" placeholder="Title" />
                            </div>
                            @error('title')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <label class="form-label float-left text-light" for="title">Description</label><br>
                            <div class="form-outline mb-1">
                                <textarea class="description text-light" name="description" style="color:white!important">
                                    {!! old('description') !!}
                                </textarea>
                            </div>
                            @error('description')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1 mt-2">
                                <label class="form-label float-left text-light" for="gender">Tags</label>
                                <textarea name='tag' class='textarea countries form-control form-control-lg input-dark border-none'
                                    placeholder="Try to add tags from the list">{{ old('tag') }}</textarea>
                            </div>
                            <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var tags = <?php echo json_encode($tags); ?>;
        var tagify = new Tagify(document.querySelector('textarea[name=tag]'), {
            delimiters: null,
            templates: {
                tag: function(tagData) {
                    try {
                        return `<tag title='${tagData.value}' contenteditable='false' spellcheck="false" class='tagify__tag ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                        <div>
                            <span class='tagify__tag-text'>${tagData.value}</span>
                        </div>
                    </tag>`
                    } catch (err) {}
                },

                dropdownItem: function(tagData) {
                    try {
                        return `<div ${this.getAttributes(tagData)} class='tagify__dropdown__item border${tagData.class ? tagData.class : ""}' >
                            <span>${tagData.value}</span><br>
                            <div class='tagify__tag-text'> ${tagData.description} </div>
                        </div>`
                    } catch (err) {
                        console.error(err)
                    }
                }
            },
            enforceWhitelist: false,
            whitelist: tags.map(({
                id,
                title,
                plain_description,
                html_description
            }) => ({
                id: id,
                value: title,
                title: title,
                description: plain_description,
                html: html_description
            })),
            dropdown: {
                enabled: 1, // suggest tags after a single character input
                classname: 'extra-properties' // custom class for the suggestions dropdown
            } // map tags' values to this property name, so this property will be the actual value and not the printed value on the screen
        })

        tagify.on('click', function(e) {
            console.log(e.detail);
        });

        tagify.on('remove', function(e) {
            console.log(e.detail);
        });

        tagify.on('add', function(e) {
            console.log("original Input:", tagify.DOM.originalInput);
            console.log("original Input's value:", tagify.DOM.originalInput.value);
            console.log("event detail:", e.detail);
            console.log($('textarea[name="tag"]').val())
        });
        // tagify.addTags(tags)

        // add the first 2 tags and makes them readonly
        // var tagsToAdd = tagify.whitelist.slice(0, 2)
        // tagify.addTags(tagsToAdd)
    </script>
@endpush
