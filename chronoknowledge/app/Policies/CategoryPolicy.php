<?php

namespace App\Policies;

use App\Http\Services\RoleService;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyCategory(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewCategory(User $user, Category $category)
    {
        return RoleService::checkAdmin($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createCategory(User $user)
    {
        return RoleService::checkAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateCategory(User $user, Category $category)
    {
        return RoleService::checkAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteCategory(User $user, Category $category)
    {
        return RoleService::checkAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreCategory(User $user, Category $category)
    {
        return RoleService::checkAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteCategory(User $user, Category $category)
    {
        return RoleService::checkAdmin($user);
    }
}
