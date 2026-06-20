<?php

namespace App\Domains\User\Models;

use App\Domains\User\Enums\RoleStatus;
use App\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    /**
     * Convierte campos de la base de datos a tipos PHP.
     */
    protected function casts(): array
    {
        return [
            'status' => RoleStatus::class,
            'is_system' => 'boolean',
        ];
    }

    /**
     * Permisos asignados a este rol.
     *
     * Ejemplo:
     * tenant_admin puede tener:
     * - birds.create
     * - birds.update
     * - users.manage
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions'
        )->withTimestamps();
    }

    /**
     * Usuarios master que tienen este rol.
     *
     * Relación muchos a muchos:
     * un usuario puede tener varios roles
     * y un rol puede pertenecer a varios usuarios.
     */
    public function masterUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            MasterUser::class,
            'master_user_roles'
        )->withTimestamps();
    }
}
