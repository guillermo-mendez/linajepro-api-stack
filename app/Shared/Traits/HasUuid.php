<?php

namespace App\Shared\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Genera automáticamente un UUID cuando se crea un modelo.
     *
     * Esto evita asignar UUID manualmente en controladores o servicios.
     * Se usa para exponer identificadores seguros en API, PWA y sincronización.
     */
    protected static function bootHasUuid(): void
    {
        static::creating(function (Model $model): void {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
