@extends('layouts.app')
@section('content')
    @if ($post)
        <div class="container py-5 h-100 mt-0" style="color: white">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-2 p-md-5 mt-0">
                            <h3>Edit post </h3>
                            <form class="px-md-2" action="{{ route('posts.update', $post) }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="category">Category</label>
                                    <select class="select form-control form-control-lg" value="{{ !old('category') ? $post->category_id : old('category') }}"
                                        name="category">
                                        <option value="1" selected>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if ($category->id == $post->category_id)
                                                selected
                                            @endif>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text text-danger mb-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="title">Title</label>
                                    <input type="text" id="title" class="form-control form-control-lg"
                                        value="{{ !old('title') ? $post->title : old('title') }}" name="title" placeholder="Title" />
                                </div>
                                @error('title')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="plainDescription">Plain Description</label>
                                    <input type="text" id="plainDescription" class="form-control form-control-lg"
                                        value="{{ !old('plain_description') ? $post->plain_description : old('plain_description') }}" name="plain_description"
                                        placeholder="Middle Name" />
                                </div>
                                @error('plain_description')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <div class="form-outline mb-1">
                                    <label class="form-label float-left" for="htmlDescription">HTML Description</label>
                                    <input type="text" id="htmlDescription" class="form-control form-control-lg"
                                        value="{{ !old('html_description') ? $post->html_description : old('html_description') }}" name="html_description"
                                        placeholder="HTML Description" />
                                </div>
                                @error('html_description')
                                    <span class="text text-danger mb-1">{{ $message }}</span>
                                @enderror
                                <div class="form-outline mb-1 ui-widget">
                                    <!-- Multiple Select -->
                                    <label class="form-label float-left" for="gender">Tags</label>
                                    <input id="tags" class="form-control form-control-lg" name="tag" value="{{ !old('tag') ?  $postTags : old('tag') }}" placeholder="Tag">
                                    {{-- <select id="tags" class="w-100 mt-2 justify-content-center form-control form-control-lg px-1 py-2 text-justify-center" multiple="multiple">
                                        <option value="1">January</option>
                                    </select> --}}

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
    $(function () {
        var availableTags = [
      @foreach ( $tags as $tag)
          '{{ $tag->title }}'
          @if (!$tag->last)
              {{ ','}}
          @endif
      @endforeach()
    ];
    console.log(availableTags)
    $( "#tags" ).autocomplete({
      source: availableTags
    });
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }

    $( "#tags" )
      // don't navigate away from the field on tab when selecting an item
      .on( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
    //   $('#tags').multipleSelect()
    })
  </script>
@endpush

