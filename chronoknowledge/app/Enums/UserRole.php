<?php

namespace App\Enums;

/**
 * Defines the role of  a user account
 */
final class UserRole
{
    const ADMIN = 1;

    const USER = 2;

    const ROLES = [
        1 => 'Admin',
        2 => 'User',
    ];
}
