@extends('layouts.app')
@section('content')
    <div class="container py-5 h-100 mt-0" style="color: white">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-2 p-md-5 mt-0">
                        <h3>Create new post </h3>
                        <form class="px-md-2" action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="category">Category</label>
                                <select class="select form-control form-control-lg" name="category">
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
                                <label class="form-label float-left" for="title">Title</label>
                                <input type="text" id="title" class="form-control form-control-lg"
                                    value="{{ old('title') }}" name="title" placeholder="Title" />
                            </div>
                            @error('title')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="plainDescription">Plain Description</label>
                                <textarea type="text" id="plainDescription" class="textarea form-control form-control-lg" value=""
                                    name="plain_description" placeholder="Plain description">{{ old('plain_description') }}</textarea>
                            </div>
                            @error('plain_description')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="htmlDescription">HTML Description</label>
                                <textarea type="text" id="htmlDescription" class="textarea form-control form-control-lg" value=""
                                    name="html_description" placeholder="HTML Description">{{ old('html_description') }}</textarea>
                            </div>
                            @error('html_description')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            {{-- <div class="form-outline mb-1 ui-widget">
                                <!-- Multiple Select -->
                                <label class="form-label float-left" for="gender">Tags</label>
                                <input id="tags" class="form-control form-control-lg" name="tag"
                                    value="{{ old('tag') }}" placeholder="Tag"> --}}
                            {{-- <select id="tags" class="w-100 mt-2 justify-content-center form-control form-control-lg px-1 py-2 text-justify-center" multiple="multiple">
                                    <option value="1">January</option>
                                </select> --}}

                            {{-- </div>
                            @error('tag')
                                <span class="text text-danger mb-2">{{ $message }}</span>
                            @enderror --}}
                            {{-- @if ($errors->any())
                                <span class="text-danger"> {{ $errors}}</span>

                            @endif --}}
                            {{-- <section id="editor">
                                2
                                <div id="edit">
                                    3
                                    Your editable content goes here
                                    4
                                </div>
                                5
                            </section> --}}
                            <div class="form-outline mb-1 mt-2">
                                <label class="form-label float-left" for="gender">Tags</label>
                                <textarea name='tag' class='textarea countries form-control form-control-lg'
                                    placeholder="Try to add tags from the list">{{ old('tag') }}</textarea>
                            </div>
                            <div class="summernote">
                                <p>jQueryScript.Net</p>
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

        $(function() {
            $('.summernote').summernote({
                // mentions: ['jayden', 'sam', 'alvin', 'david'],
                // match: /\B@(\w*)$/,
                // search: function(keyword, callback) {
                //     callback($.grep(this.mentions, function(item) {
                //         return item.indexOf(keyword) == 0;
                //     }));
                // },
                // content: function(item) {
                //     return '@' + item;
                // }
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        })
    </script>
@endpush
