<?php

namespace App\Domains\User\Models;

use App\Domains\Tenant\Models\Tenant;
use App\Domains\User\Enums\UserStatus;
use App\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MasterUser extends BaseModel
{
    /**
     * Convierte status a UserStatus automáticamente.
     */
    protected function casts(): array
    {
        return [
            'status' => UserStatus::class,
            'last_login_at' => 'datetime',
            'pin_changed_at' => 'datetime',
        ];
    }

    /**
     * Tenant/Gallera al que pertenece el usuario.
     *
     * Ejemplo:
     * Usuario PEDRO pertenece al tenant 482751.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Roles asignados al usuario.
     *
     * Ejemplo:
     * PEDRO puede tener:
     * - tenant_admin
     * - operator
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'master_user_roles'
        )->withTimestamps();
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     *
     * Ejemplo:
     * $user->hasRole('tenant_admin')
     */
    public function hasRole(string $roleCode): bool
    {
        return $this->roles()
            ->where('code', $roleCode)
            ->exists();
    }

    /**
     * Verifica si el usuario tiene un permiso específico
     * a través de sus roles.
     *
     * Ejemplo:
     * $user->hasPermission('birds.create')
     */
    public function hasPermission(string $permissionCode): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permissionCode): void {
                $query->where('code', $permissionCode);
            })
            ->exists();
    }
}
