<?php

namespace App\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseModel extends Model
{
    protected $guarded = [];

    protected bool $usesUuid = true;

    protected static function booted(): void
    {
        static::creating(function (Model $model): void {
            if (
                property_exists($model, 'usesUuid') &&
                $model->usesUuid === true &&
                empty($model->uuid)
            ) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
