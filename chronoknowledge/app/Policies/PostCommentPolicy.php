<?php

namespace App\Policies;

use App\Models\PostComment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Services\RoleService;

class PostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyComments(User $user)
    {
        return RoleService::isUser();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewComment(User $user, PostComment $postComment)
    {
        return $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createComment()
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }
}
