<?php

namespace App\Domains\User\Models;

use App\Domains\User\Enums\PermissionStatus;
use App\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends BaseModel
{
    /**
     * Convierte status a PermissionStatus automáticamente.
     */
    protected function casts(): array
    {
        return [
            'status' => PermissionStatus::class,
        ];
    }

    /**
     * Roles que tienen este permiso asignado.
     *
     * Ejemplo:
     * birds.create puede estar asignado a:
     * - tenant_admin
     * - operator
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'role_permissions'
        )->withTimestamps();
    }
}
