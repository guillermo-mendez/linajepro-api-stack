<?php

namespace App\Domains\Tenant\Enums;

enum DatabaseConnectionProfileStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case MAINTENANCE = 'maintenance';
}
