<?php

namespace App\Domains\User\Enums;

enum RoleStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
