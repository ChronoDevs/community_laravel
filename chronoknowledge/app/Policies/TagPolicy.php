<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\UserRole;
use App\Http\Services\RoleService;
use Illuminate\Support\Facades\Auth;

class TagPolicy
{
    use HandlesAuthorization;

    private $role;

    public function __construct(RoleService $role)
    {
        $this->role = $role;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyTag(User $user)
    {
        // return $this->defaultChecker($user);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewTag(User $user, Tag $tag)
    {
        // return $this->defaultChecker($user);
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createTag(User $user)
    {
        return $this->defaultChecker($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateTag(User $user, Tag $tag)
    {
        return $this->defaultChecker($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteTag(User $user, Tag $tag)
    {
        return $this->defaultChecker($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreTag(User $user, Tag $tag)
    {
        return $this->defaultChecker($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteTag(User $user, Tag $tag)
    {
        return $this->defaultChecker($user);
    }

    public function defaultChecker($user)
    {
        return $user->id == Auth::id() && $this->role->isAdmin();
    }
}
