<?php

namespace App\Domains\Tenant\Models;

use App\Domains\Tenant\Enums\DatabaseConnectionProfileStatus;
use App\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;

class DatabaseConnectionProfile extends BaseModel
{
    protected function casts(): array
    {
        return [
            'status' => DatabaseConnectionProfileStatus::class,
            'use_tls' => 'boolean',
        ];
    }

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    public function setEncryptedPasswordAttribute(string $value): void
    {
        $this->attributes['encrypted_password'] = Crypt::encryptString($value);
    }

    public function getDecryptedPassword(): string
    {
        return Crypt::decryptString($this->encrypted_password);
    }
}
