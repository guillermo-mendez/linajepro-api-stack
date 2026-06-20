<?php

namespace App\Domains\User\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case INACTIVE = 'inactive';
}
