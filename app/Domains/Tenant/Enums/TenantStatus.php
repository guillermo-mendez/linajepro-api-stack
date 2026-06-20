<?php

namespace App\Domains\Tenant\Enums;

enum TenantStatus: string
{
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case CANCELLED = 'cancelled';
}
