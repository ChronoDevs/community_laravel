@extends('layouts.app')
@section('content')
    <a id="createPostBtn" href="{{ route('posts.create') }}"
        class="btn btn-primary text-decoration-none text-primary text-white mt-1"
        style="position:sticky;top:12vh;left:70%;z-index:3">New Post<i class="fa-regular fa-plus ms-1"></i></a>
    <div class="row flex justify-content-center justify-items-center align-items-center ms-auto me-auto">
        <div class="flex text-left col-md-10 col-xl-8 col-lg-10 col-sm-10 col-xs-12 ms-auto me-auto">
            <div class="container filterDiv my-auto clearfix mx-auto mb-3 ms-5">
                <span class="mx-2 filter">
                    <a href="{{ '?filter=relevant' }}" class="upperFilterActive filter">Relevant</a>
                </span>
                <span class="mx-2 text-primary filter">
                    <a href="{{ '?filter=latest' }}" class="upperFilter filter">Latest</a>
                </span>
                <span class="mx-2 text-primary filter">
                    <a href="{{ '?filter=top' }}" class="upperFilter filter">Top</a>
                </span>
            </div>
            @forelse ($posts as $post)
                <div class="card postCard text-white mb-3 post w-75 ms-auto me-auto">
                    <div class="card-header postHeader flex justify-content-space-around">
                        <div class="row" style="display:flex;justify-content:space-between">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 my-auto w-fit-content"
                                style="width:fit-content">
                                <a href="/" class="text-decoration-none w-fit-content">
                                    <img src="{{ asset('storage/assets/avatar.png') }}" alt="avatar"
                                        class="img-fluid ownerProfile rounded-circle" width="55" height="auto">
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ms-1 me-auto" style="width:fit-content">
                                <span class="text-center text-info postOwner">{{ $post['user']['name'] }}</span><br>
                                <span class="text-center text-white ownerTitle">{{ $post['user']['job_title'] }}</span><br>
                                <span
                                    class="text-center text-white text-muted postedAt">{{ $post->created_at->diffForHumans() }}</span><br>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-2 col-xs-2 justify-end py-auto buttonsDiv" style="width:fit-content">
                                @can('updatePost', $post)
                                    <a class="btn btn-primary text-white updatePostIcon mb-2" href="{{ route('posts.edit', $post) }}"><i
                                            class="fa fa-pencil"></i></a><br>
                                @endcan
                                @can('deletePost', $post)
                                    <form id="deleteForm-{{ $post->id }}" class="deletePostForm"
                                        action="{{ route('posts.destroy', $post) }}" style="display: none" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="javascript:void(0)" class="btn btn-danger text-white deletePost deletePostIcon"><i
                                            class="fa fa-trash"></i></a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <a class=" text-white" href="{{ route('posts.show', $post) }}">
                                <h5 class="card-title text-wrap postTitle">
                                    {{ $post->title }}
                                </h5>
                            </a>
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
                                    <img src="{{ asset('storage/assets/avatar.png') }}"
                                        class="commentProfile img-fluid rounded-circle" style="width: 35px;">
                                </a>
                                <span class="card-subtitle mr-1 ml-2">
                                    {{ $comment->user->name }}
                                </span>
                                <span class="card-subtitle mr-6 commentedAt">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                                @can('updateComment', $comment)
                                    <button class="btn text-primary editComment"><i
                                            class="fa-solid fa-pen"></i></button>
                                @endcan
                                @can('deleteComment', $comment)
                                    <button class="btn text-danger deleteComment"><i
                                            class="fa-solid fa-trash"></i></button>
                                @endcan
                                <input type="hidden" name="post_id" class="postIdForComment"
                                    value="{{ $post->id }}">
                                <input type="hidden" name="user_id" class="userIdForComment"
                                    value="{{ auth()->id() }}">
                                <input type="hidden" name="id" class="idForComment"
                                    value="{{ $comment->id }}">
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
                                    <input type="hidden" name="postId" value="{{ $post->id }}"
                                        class="postId">
                                    <input type="hidden" name="userId" value="{{ auth()->id() }}"
                                        class="userId">
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
    @empty
        <div class="container flex text-center justify-center text-light">No post found.</div>
    @endforelse
    <div class="container my-3 bg-transparent mx-2">{!! $posts->links() !!}</div>
</div>
</div>
@include('comments.modal')
@endsection
@push('scripts')
<script type="text/javascript">
    const count = <?= json_encode($count) ?>;
    const postCount = <?= json_encode($posts->count()) ?>;

    $(document).ready(function() {
        $('.deletePost').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).siblings('.deletePostForm').submit();
                };
            })
        });

        //reserved for infinite loading via scroll
        window.onscroll = function() {
            if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
                if (postCount < count ) {
                    let paginate = Math.ceil(postCount / 10)+ 1;
                    // if (window.location.href.includes('?') && !window.location.href.includes('pagination')) {
                    //     console.log(true)
                    //     window.location.replace(window.location.href + '&pagination=' + (paginate * 10))
                    //     return;
                    // }

                    // if (window.location.href.includes('?') && !window.location.href.includes('pagination')) {

                    //     // window.location.replace(window.location.href.replace() + '&pagination=' + (paginate * 10))
                    // }

                    // window.location.replace('?pagination=' + (paginate * 10))
                } else {
                    $('#stopPaginate').show();
                }
            }
        }
    })
</script>
@endpush
