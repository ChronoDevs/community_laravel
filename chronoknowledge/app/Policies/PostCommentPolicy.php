<?php

namespace App\Policies;

use App\Http\Services\RoleService;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyComments(User $user)
    {
        // return RoleService::isUser();
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewComment(User $user, PostComment $postComment)
    {
        return true;
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
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteComment(User $user, PostComment $postComment)
    {
        return RoleService::isUser() && $user->id === $postComment->user_id;
    }
}
