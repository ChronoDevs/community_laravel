<?php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Tag;
use App\Policies\PostPolicy;
use App\Policies\PostLikePolicy;
use App\Policies\PostCommentPolicy;
use App\Policies\{TagPolicy, PostFavoritePolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Post' => 'App\Policies\PostPolicy',
        Post::class => PostPolicy::class,
        PostLike::class => PostLikePolicy::class,
        PostComment::class => PostCommentPolicy::class,
        PostFavorite::class => PostFavoritePolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
