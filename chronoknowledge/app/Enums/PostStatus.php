<?php

namespace App\Enums;

/**
 * Defines the role of  a user account
 */
final class PostStatus
{
    const INACTIVE = 0;

    const ACTIVE = 1;

    const ROLES = [
        0 => 'Inactive',
        1 => 'Active',
    ];
}
