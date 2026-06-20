<?php

namespace App\Domains\Tenant\Models;

use App\Domains\Tenant\Enums\TenantStatus;
use App\Domains\User\Models\MasterUser;
use App\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends BaseModel
{
    protected function casts(): array
    {
        return [
            'status' => TenantStatus::class,
            'last_sync_at' => 'datetime',
        ];
    }

    public function databaseConnectionProfile(): BelongsTo
    {
        return $this->belongsTo(DatabaseConnectionProfile::class);
    }

    public function masterUsers(): HasMany
    {
        return $this->hasMany(MasterUser::class);
    }
}
