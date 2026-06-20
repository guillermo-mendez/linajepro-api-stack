<?php

namespace App\Domains\User\Enums;

enum PermissionStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
