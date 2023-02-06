<?php

namespace App\Enums;
/**
 *
 * Defines the role of  a user account
 */
final class UserGender
{
    const EMPTY = '';
    const FEMALE = 1;
    const MALE = 2;
    const OTHER = 3;

    const GENDERS = [
        0 => '',
        1 => 'Female',
        2 => 'Male',
        3 => 'Other'
    ];
}
