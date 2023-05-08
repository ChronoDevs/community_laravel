<?php
namespace App\Policies;

use App\Models\PostFavorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Services\RoleService;

class PostFavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyFavorite(User $user)
    {
        // return RoleService::isUser();
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostFavorite  $postFavorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PostFavorite $postFavorite)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostFavorite  $postFavorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PostFavorite $postFavorite)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostFavorite  $postFavorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteFavorite(User $user, PostFavorite $postFavorite)
    {
        // return dd($postFavorite);
        return $user->id === $postFavorite->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostFavorite  $postFavorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PostFavorite $postFavorite)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostFavorite  $postFavorite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PostFavorite $postFavorite)
    {
        //
    }
}
