<?php

namespace App\Http\Services;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    /**
     * Returns true if admin
     *
     * @return bool
     */
    public static function isAdmin()
    {
        return Auth::check() && Auth::user()->role_id === UserRole::ADMIN;
    }

    /**
     * Returns true if admin
     *
     * @return bool
     */
    public static function isUser()
    {
        return Auth::check() && Auth::user()->role_id === UserRole::USER;
    }

    public static function checkAdmin($user)
    {
        return $user->id == Auth::id() && RoleService::isAdmin();
    }
}
