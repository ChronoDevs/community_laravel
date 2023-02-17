@extends('layouts.app')
@section('content')
    @if ($post)
        <div class="container py-2 h-100 mt-0" style="color: white">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-2 p-md-5 mt-0 flex text-center">
                            <h3 class="ms-auto me-auto text-light">Edit post </h3>
                            <form class="px-md-2" action="{{ route('posts.update', $post) }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="category">Category</label>
                                    <select class="select form-control form-control-lg input-dark"
                                        value="{{ !old('category') ? $post->category_id : old('category') }}"
                                        name="category">
                                        <option value="1" selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option  value="{{ $category->id }}"
                                                @if ($category->id == $post->category_id) selected @endif>{{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text text-danger mb-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="title">Title</label>
                                    <input type="text" id="title" class="form-control form-control-lg input-dark"
                                        value="{{ !old('title') ? $post->title : old('title') }}" name="title"
                                        placeholder="Title" />
                                </div>
                                @error('title')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <label class="form-label float-left" for="title">Description</label><br>
                                <div class="form-outline mb-1">
                                <textarea class="description input-dark flex text-left" name="description" onkeyup="console.log(this)">
                                    {!! !old('description') ? $post->html_description : old('description') !!}
                                </textarea>
                                </div>
                                @error('description')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <div class="form-outline mb-1 mt-2">
                                    <label class="form-label float-left" for="gender">Tags</label>
                                    <textarea name='tag' class='textarea text-light countries form-control form-control-lg input-dark' placeholder="Try to add tags from the list">{{ old('tag') }}</textarea>
                                </div>
                                @error('tag')
                                    <span class="text text-danger mb-2">{{ $message }}</span>
                                @enderror
                                <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        $(function() {
            var tags = <?php echo json_encode($tags) ?>;
            var postTags = <?php echo json_encode($postTags); ?>;
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
                            return `<div ${this.getAttributes(tagData)} class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' >
                            <span>${tagData.value}</span><br>
                            <div class='tagify__tag-text'>${tagData.description}</div>
                        </div>`
                        } catch (err) {
                            console.error(err)
                        }
                    }
                },
                enforceWhitelist: false,
                duplicates: true,
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
            console.log(postTags)
            postTags = postTags.map(({
                    title
                }) => ({
                    value: title,
                    title: title,
                })),
            tagify.addTags(postTags)

            // add the first 2 tags and makes them readonly
            // var tagsToAdd = tagify.whitelist.slice(0, 2)
            // tagify.addTags(tagsToAdd)
        })
    </script>
@endpush
