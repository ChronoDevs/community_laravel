<?php

namespace App\Enums;

/**
 * Defines the role of  a user account
 */
final class UserJobTitle
{
    const SOFTWARE_ENGINEER = 1;

    const QUALITY_ASSURANCE_ENGINEER = 2;

    const PROJECT_MANAGER = 3;

    const TITLES = [
        1 => 'Software Engineer',
        2 => 'Quality Assurance Engineer',
        3 => 'Project Manager',
    ];
}
