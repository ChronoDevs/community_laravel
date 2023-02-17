@extends('layouts.app')
@section('sidebar')
@section('content')
    <div class="container ms-auto me-auto w-75 position-relative col-md-6 col-xl-8 col-lg-8">
        <div class="card postCard w-100 h-auto text-white mb-3 post ms-auto me-auto">
            <div class="card-header">
                <div class="container flex justify-left ms-auto me-auto">
                    <div class="row">
                        <div class="col-lg-2 my-auto">
                            <a href="#!" class="text-decoration-none">
                                <img src="{{ asset('storage/assets/avatar.png') }}" alt="avatar"
                                    class="img-fluid rounded-circle me-1" width="55" height="auto">
                            </a>
                        </div>
                        <div class="col-lg-6 ms-0">
                            <span class="text-center text-info">{{ $post['user']['name'] }}</span><br>
                            <span class="text-center text-white">{{ $post['user']['job_title'] }}</span><br>
                            <span
                                class="text-center text-white text-muted">{{ $post->created_at->diffForHumans() }}</span><br>
                        </div>
                        <div class="col justify-end py-auto">
                            @can('updatePost', $post)
                                <a class="btn btn-primary text-white" href="{{ route('posts.edit', $post) }}"><i
                                        class="fa fa-pencil"></i></a>
                            @endcan
                            @can('deletePost', $post)
                                <form id="deleteForm-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}"
                                    style="display: none" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a class="btn btn-danger text-white" href="javascript:void(0)"
                                    onclick="deletePost({{ $post->id }})"><i class="fa fa-trash"></i></a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title my-5 mt-2 text-wrap">
                    {{ $post->title }}
                </h5>
                <p class="card-text my-2 text-wrap">
                    {!! $post->html_description !!}
                </p>
                <div class="row">
                    @foreach ($post->tags as $tag)
                        <div class="col">
                            #{{ $tag->description }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer ">
                <span class="postId" style="display: none">{{ $post->id }}</span>
                <span class="userId" style="display: none">{{ auth()->id() }}</span>
                @forelse ($post->likes as $like)
                    @can('deleteLike', $like)
                        <span class="userId" style="display: none">{{ auth()->id() }}</span>
                        <button class="btn btn-transparent icons likeBtn activeLike">
                            <img src="{{ asset('storage/assets/active_like.svg') }}">
                        </button>
                    @break
                @endcan
                @cannot('deleteLike', $like)
                    @if ($loop->last)
                        <span class="userId" style="display: none">{{ auth()->id() }}</span>
                        <button class="btn btn-transparent icons likeBtn">
                            <img src="{{ asset('storage/assets/like.svg') }}">
                        </button>
                    @endif
                @endcannot
            @empty
                <button class="btn btn-transparent icons likeBtn">
                    <img src="{{ asset('storage/assets/like.svg') }}">
                </button>
            @endforelse
            <span class="count like ms-1">{{ $post->likes->count() }}</span>
            <span class="fs-6">likes</span>
            <button class="btn btn-transparent icons commentBtn">
                <img src="{{ asset('storage/assets/comment.svg') }}" alt="">

            </button>
            <span class="count comment ms-1">{{ $post->comments->count() }}</span>
            <span class="fs-6">comments</span>
            @forelse ($post->favorites as $favorite)
                @can('deleteFavorite', $favorite)
                    <span class="userId" style="display: none">{{ $post->user_id }}</span>
                    <button class="btn btn-transparent icons favoriteBtn activeFavorite">
                        <img src="{{ asset('storage/assets/active_favorite.svg') }}" alt="">
                    </button>
                @break
            @endcan
            @cannot('deleteFavorite', $favorite)
                @if ($loop->last)
                    <span class="userId" style="display: none">{{ $post->user_id }}</span>
                    <button class="btn btn-transparent icons favoriteBtn">
                        <img src="{{ asset('storage/assets/favorite.svg') }}" alt="">
                    </button>
                @endif
            @endcan
        @empty
            <button class="btn btn-transparent icons favoriteBtn">
                <img src="{{ asset('storage/assets/favorite.svg') }}" alt="">
            </button>
        @endforelse
        <span class="count favorite ms-3">{{ $post->favorites->count() }}</span>
        <span class="fs-6">favorites</span>
    </div>
    <div class="collapse commentCollapse">
        <h6 class="mt-1 mb-1" style="width: fit-content;margin-left:auto;margin-right:auto">Comments</h6>
        <div class="container mt-2 mb-2 row">
            @forelse ($post->comments->sortByDesc('created_at') as $comment)
                <div class="col-sm-12 card mt-1" style="height:fit-content;">
                    <div class="card-header">
                        <a href="">
                            <img src="https://www.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png"
                                class="commentProfile img-fluid rounded-circle" style="width: 35px;">
                        </a>
                        <span class="card-subtitle mr-1 ml-2">
                            {{ $comment->user->name }}
                        </span>
                        <span class="card-subtitle mr-6 commentedAt">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                        @can('updateComment', $comment)
                            <button class="btn text-primary editComment"><i class="fa-solid fa-pen"></i></button>
                        @endcan
                        @can('deleteComment', $comment)
                            <button class="btn text-danger deleteComment"><i class="fa-solid fa-trash"></i></button>
                        @endcan
                        <input type="hidden" name="post_id" class="postIdForComment" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" class="userIdForComment"
                            value="{{ $comment->user_id }}">
                        <input type="hidden" name="id" class="idForComment" value="{{ $comment->id }}">
                    </div>
                    <div class="card-body comment py-1 px-1" style="white-space: pre-line">
                        {{ $comment->description }}
                    </div>
                </div>
            @empty
                <span class="text-normal text-center ms-auto me-auto text">No comment</span>
            @endforelse
            <div class="container mt-6 px-6 mx-5 my-3">
                <form class="form addComment" method="POST" action="/share/comment">
                    @csrf
                    <div class="form mb-2 row col-12">
                        <div class="col-sm-9">
                            <textarea type="text" class="textarea form-control ml-4 textAreaComment" name="comment" id="commentPerPost"
                                placeholder="Enter description here..." rows="3" cols="100"></textarea>
                            <span class="ml-12 characterCountComment" style="margin-left:59%">0
                                character</span>
                            <input type="hidden" name="postId" value="{{ $post->id }}" class="postId">
                            <input type="hidden" name="userId" value="{{ auth()->id() }}" class="userId">
                        </div>
                        <div class="col-sm-2 mt-4">
                            <span class="ml-2" style="color:red">*</span>
                            <button class="btn btn-dark text-info" type="submit"><i
                                    class="fa-regular fa-paper-plane"></i></button>
                        </div>
                        <div class="col-sm-12 text-danger m-4 p-2 errorComment" style="display: none;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@include('comments.modal')
@endsection
