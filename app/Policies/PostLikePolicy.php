<?php

namespace App\Policies;

use App\Models\PostLike;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Services\RoleService;

class PostLikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyLikes(User $user)
    {
        return RoleService::isUser();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostLike  $postLike
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewLike(User $user, PostLike $postLike)
    {
        return $user->id === $postLike->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createLike()
    {
        return RoleService::isUser();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostLike  $postLike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateLike(User $user, PostLike $postLike)
    {
        return $user->id === $postLike->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostLike  $postLike
     * @param \App\Models\Post $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteLike(User $user, PostLike $postLike)
    {
        return $user->id === $postLike->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostLike  $postLike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreLike(User $user, PostLike $postLike)
    {
        return $user->id === $postLike->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostLike  $postLike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteLike(User $user, PostLike $postLike)
    {
        return $user->id === $postLike->user_id;
    }
}
